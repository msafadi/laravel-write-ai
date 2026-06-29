@auth
    @if(auth()->id() !== $user->id)
        <form
            method="POST"
            action="{{ route($following ? 'users.unfollow' : 'users.follow', $user->id) }}"
            class="inline"
        >
            @csrf
            @if($following)
                @method('DELETE')
            @endif

            @if($variant === 'text')
                <button type="submit"
                    class="{{ $following
                        ? 'text-secondary hover:text-error transition-colors font-ui-label text-metadata font-bold'
                        : 'text-primary hover:underline font-ui-label text-metadata font-bold' }}">
                    {{ $following ? 'Unfollow' : 'Follow' }}
                </button>
            @else
                <button type="submit"
                    class="{{ $following
                        ? 'px-4 py-1.5 border border-outline-variant hover:border-error hover:text-error text-metadata font-ui-button font-bold rounded-full transition-colors'
                        : 'px-4 py-1.5 bg-primary text-on-primary text-metadata font-ui-button font-bold rounded-full hover:opacity-90 transition-opacity' }}">
                    {{ $following ? 'Unfollow' : 'Follow' }}
                </button>
            @endif
        </form>
    @endif
@else
    @if($variant === 'text')
        <a href="{{ route('login') }}"
            class="text-primary hover:underline font-ui-label text-metadata font-bold">Follow</a>
    @else
        <a href="{{ route('login') }}"
            class="px-4 py-1.5 bg-primary text-on-primary text-metadata font-ui-button font-bold rounded-full hover:opacity-90 transition-opacity">Follow</a>
    @endif
@endauth