<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimplePie\SimplePie;

class FeedController extends Controller
{
    public function show()
    {
        if (Auth::guest()) {
            $opmlPath = public_path("data/sample-feeds.opml");
            $xml = simplexml_load_file($opmlPath);

            $categories = collect();
            $feeds = collect();

            foreach ($xml->body->outline as $categoryNode) {
                $categoryName = (string) $categoryNode['text'];

                $categories->push((object)[
                    'id' => $categories->count() + 1,
                    'name' => $categoryName,
                ]);

                foreach ($categoryNode->outline as $feedNode) {
                    $feeds->push((object)[
                        'category_id' => $categories->count(),
                        'title' => (string) $feedNode['title'],
                        'url' => (string) ($feedNode['xmlUrl'] ?? $feedNode['xmlurl']),
                    ]);
                }
            }

            foreach ($feeds as $feed) {
                $pie = new SimplePie();
                $pie->set_feed_url($feed->url);
                $pie->enable_cache(false);
                $pie->init();

                $feed->favicon = $pie->get_favicon();
                $feed->items = $pie->get_items() ?? [];
            }

            return view("index", compact("feeds", "categories"));
        }

        $feeds = Feed::where("user_id", Auth::id())->get();
        foreach ($feeds as $feed) {
            $pie = new SimplePie();
            $pie->set_feed_url($feed->url);
            $pie->enable_cache(false);
            $pie->init();

            if (!$pie->error()) {
                $feed->update([
                    "last_fetch_at" => now(),
                    "last_health_status" => "active",
                    "health_status" => "active",
                ]);

                $feed->items = $pie->get_items() ?? [];
            } else {
                $feed->update(["health_status" => "error"]);
                $feed->items = [];
            }
        }

        $categories = Category::where("user_id", Auth::id())->get();
        return view('index', compact("feeds", "categories"));
    }

    public function store(Request $request)
    {
        $url = $request->validate(
            [
                "feed-url" => ["required", "url"],
                "select-category" => ["nullable", "integer", "exists:categories,id"]
            ]
        );

        $feed = new SimplePie();
        $feed->set_feed_url($url["feed-url"]);
        $feed->enable_cache(false);
        $feed->init();

        if ($feed->error()) {
            return back()->withErrors([
                'url' => 'This URL does not contain a valid RSS or Atom feed.'
            ]);
        }

        Feed::create(
            [
                "user_id" => Auth::id(),
                "url" => $url["feed-url"],
                "title" => $feed->get_title(),
                "description" => $feed->get_description(),
                "favicon" => $feed->get_favicon(),
                "category_id" => $url["select-category"] ?: null,
            ]
        );

        return redirect("/")->with("success", "Feed added.");
    }
}
