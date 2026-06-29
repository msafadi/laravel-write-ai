@props(['post'])

@auth
    @php
        $isBookmarked = $post->isBookmarkedBy(auth()->user());
    @endphp

    <form action="{{ $isBookmarked ? route('posts.unbookmark', $post) : route('posts.bookmark', $post) }}" method="POST" class="inline-flex items-center justify-center">
        @csrf
        @if($isBookmarked)
            @method('DELETE')
        @endif
        <button type="submit" {{ $attributes->merge(['class' => 'material-symbols-outlined transition-colors focus:outline-none cursor-pointer']) }}
            style="font-variation-settings: 'FILL' {{ $isBookmarked ? '1' : '0' }};">
            bookmark
        </button>
    </form>
@else
    <a href="{{ route('login') }}" {{ $attributes->merge(['class' => 'material-symbols-outlined transition-colors focus:outline-none cursor-pointer']) }}>
        bookmark
    </a>
@endauth
