<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $page = $request->query('page', 1);
        $key = "home_posts_{$page}";
        $posts = Cache::get($key);

        if (! $posts) {
            $posts = Post::published()
                ->with(['user', 'category'])
                ->latest('published_at')
                ->paginate();
            Cache::put($key, $posts, now()->addMinutes(5));
        }

        return view('home', compact('posts'));
    }
}
