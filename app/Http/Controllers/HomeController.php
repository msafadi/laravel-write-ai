<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::published()
            ->with(['user', 'category'])
            ->latest('published_at')
            ->paginate(10);

        return view('home', compact('posts'));
    }
}
