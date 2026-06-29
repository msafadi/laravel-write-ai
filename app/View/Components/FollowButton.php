<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FollowButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  User  $user  The author to follow or unfollow.
     * @param  bool  $following  Whether the authenticated user already follows this author.
     * @param  string  $variant  Display variant: 'pill' (default) or 'text'.
     */
    public function __construct(
        public User $user,
        public bool $following = false,
        public string $variant = 'pill',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.follow-button');
    }
}
