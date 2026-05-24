<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function taggedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
}
