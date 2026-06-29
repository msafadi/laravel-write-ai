<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Handle the incoming search request.
     */
    public function __invoke(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type', 'all');

        $posts = null;
        $authors = null;
        $tags = null;

        // 1. Articles Query
        if (in_array($type, ['all', 'articles'])) {
            $posts = Post::query()
                ->published()
                ->with(['user', 'category', 'tags'])
                ->when($query, function ($q, $query) {
                    $q->where(function ($sub) use ($query) {
                        $sub->where('title', 'like', "%{$query}%")
                            ->orWhere('content', 'like', "%{$query}%")
                            ->orWhereHas('user', function ($u) use ($query) {
                                $u->where('name', 'like', "%{$query}%");
                            })
                            ->orWhereHas('category', function ($c) use ($query) {
                                $c->where('name', 'like', "%{$query}%");
                            })
                            ->orWhereHas('tags', function ($t) use ($query) {
                                $t->where('name', 'like', "%{$query}%");
                            });
                    });
                })
                ->latest('published_at')
                ->paginate(10)
                ->withQueryString();
        }

        // 2. Authors Query
        if ($type === 'authors') {
            $authors = User::query()
                ->when($query, function ($q, $query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->withCount(['posts' => fn ($q) => $q->published()])
                ->withExists(['followers' => function ($query) {
                    $query->where('follower_id', Auth::id() ?? 0);
                }])
                ->orderByDesc('posts_count')
                ->paginate(10)
                ->withQueryString();
        }

        // 3. Tags Query
        if ($type === 'tags') {
            $tags = Tag::query()
                ->when($query, function ($q, $query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->paginate(15)
                ->withQueryString();
        }

        // 4. Sidebar Data
        // Top Authors: users with most published posts
        $topAuthors = User::query()
            ->withCount(['posts' => fn ($q) => $q->published()])
            ->withExists(['followers' => function ($query) {
                $query->where('follower_id', Auth::id() ?? 0);
            }])
            ->orderByDesc('posts_count')
            ->take(3)
            ->get();

        // Related Tags: tags with most posts
        $relatedTags = Tag::query()
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->take(8)
            ->get();

        return view('search-results', compact(
            'posts',
            'authors',
            'tags',
            'query',
            'type',
            'topAuthors',
            'relatedTags'
        ));
    }
}
