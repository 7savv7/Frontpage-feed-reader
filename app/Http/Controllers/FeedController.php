<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\FeedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimplePie\SimplePie;

class FeedController extends Controller
{
    public function show()
    {
        $feeds = Feed::with([
            'items' => function ($q) {
                $q->latest();
            },
            'category'
        ])->where('user_id', Auth::id())->get();

        $new = 0;

        foreach ($feeds as $feed) {
            $new += $feed->countNewItems();
        }

        $totalItems = FeedItem::whereIn('feed_id', $feeds->pluck('id'))->count();

        return view('index', compact('feeds', 'new', 'totalItems'));
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

        $newFeed = Feed::create(
            [
                "user_id" => Auth::id(),
                "url" => $url["feed-url"],
                "title" => $feed->get_title(),
                "description" => $feed->get_description(),
                "favicon" => $feed->get_favicon(),
                "category_id" => $url["select-category"] ?? null,
            ]
        );

        foreach ($feed->get_items() as $item) {
            FeedItem::create([
                'feed_id' => $newFeed->id,
                'title' => $item->get_title(),
                'url' => $item->get_link(),
                'description' => $item->get_description(),
                'published_at' => $item->get_date('Y-m-d H:i:s'),
            ]);
        }

        return redirect("/")->with("success", "Feed added.");
    }

    public function refresh()
    {
        $feeds = Feed::where('user_id', Auth::id())->get();

        $totalAdded = 0;

        foreach ($feeds as $feed) {
            $totalAdded += $feed->fetchNewItems();
        }

        return back()->with('success', "$totalAdded new items added.");
    }

    public function readAll()
    {
        FeedItem::whereHas('feed', function ($q) {
            $q->where('user_id', Auth::id());
        })->update(['seen' => true]);

        return back()->with('success', 'All items marked as read.');
    }
}
