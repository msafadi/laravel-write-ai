<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostObserver
{

    public function saved(Post $post): void
    {
        // Clear the cache for the home page when a post is saved
        $page = 1; // Assuming you want to clear the cache for the first page
        $key = "home_posts_{$page}";
        if (Cache::has($key)) {
            Cache::forget($key);
        }
    }

    /**
     * Handle the Post "creating" event.
     */
    public function creating(Post $post): void
    {
        if (! $post->slug) {
            $post->slug = Str::slug($post->title);
        }

        if (! $post->user_id) {
            $post->user_id = Auth::id();
        }
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
    }
}
