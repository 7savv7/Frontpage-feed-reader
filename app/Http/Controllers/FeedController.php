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
        $feeds = Feed::with(['items' => function ($q) {
            $q->latest()->limit(20);
        }, 'category'])
            ->where('user_id', Auth::id())
            ->get();

        return view('index', compact('feeds'));
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
                "category_id" => $url["select-category"] ?? null,
            ]
        );

        return redirect("/")->with("success", "Feed added.");
    }
}
