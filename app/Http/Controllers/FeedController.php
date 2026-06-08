<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimplePie\SimplePie;

class FeedController extends Controller
{
    public function show()
    {
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
        return view('index', compact("feeds"));
    }

    public function store(Request $request)
    {
        $url = $request->validate(["feed-url" => ["required", "url"]]);

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
                "favicon" => $feed->get_favicon()
            ]
        );

        return redirect("/")->with("success", "Feed added.");
    }
}
