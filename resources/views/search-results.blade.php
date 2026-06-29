<x-layout title="Search results">
    @php
    $totalCount = match($type) {
    'articles' => $posts ? $posts->total() : 0,
    'authors' => $authors ? $authors->total() : 0,
    'tags' => $tags ? $tags->total() : 0,
    default => $posts ? $posts->total() : 0,
    };
    @endphp

    <main class="pt-24 pb-section-gap px-gutter max-w-container-max mx-auto">
        <!-- Search Header -->
        <section class="mb-12">
            <p class="text-metadata font-metadata text-secondary mb-2 uppercase tracking-widest">Search results</p>
            <h1 class="font-display-lg text-display-lg text-on-surface mb-6 italic">
                @if($query)
                Showing {{ $totalCount }}
                {{ Str::plural(match($type) { 'authors' => 'author', 'tags' => 'tag', default => 'result' }, $totalCount) }}
                for <span class="text-primary not-italic">"{{ $query }}"</span>
                @else
                Search results
                @endif
            </h1>
            <!-- Filter Tabs -->
            <div class="flex gap-8 border-b border-outline-variant">
                <a href="{{ route('search', ['q' => $query, 'type' => 'all']) }}"
                    class="pb-4 font-ui-label text-ui-label transition-colors {{ $type === 'all' ? 'text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim' : 'text-on-surface-variant font-medium hover:text-on-surface' }}">
                    All Results
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'articles']) }}"
                    class="pb-4 font-ui-label text-ui-label transition-colors {{ $type === 'articles' ? 'text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim' : 'text-on-surface-variant font-medium hover:text-on-surface' }}">
                    Articles
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'authors']) }}"
                    class="pb-4 font-ui-label text-ui-label transition-colors {{ $type === 'authors' ? 'text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim' : 'text-on-surface-variant font-medium hover:text-on-surface' }}">
                    Authors
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'tags']) }}"
                    class="pb-4 font-ui-label text-ui-label transition-colors {{ $type === 'tags' ? 'text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim' : 'text-on-surface-variant font-medium hover:text-on-surface' }}">
                    Tags
                </a>
            </div>
        </section>

        <!-- Main Layout: Sidebar & Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Main Content Area -->
            <div class="md:col-span-8 space-y-12">
                @if($totalCount === 0)
                <!-- No Results Found State -->
                <div
                    class="flex flex-col items-center justify-center text-center py-16 px-6 bg-surface-container-low rounded-xl border border-outline-variant/30">
                    <span class="material-symbols-outlined text-6xl text-secondary mb-4 opacity-40">search_off</span>
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-2">No results found</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                        We couldn't find any matches for <span class="font-semibold text-primary">"{{ $query }}"</span>.
                        Try checking your spelling or searching with different keywords.
                    </p>
                </div>
                @else
                <!-- Articles / All Results -->
                @if(in_array($type, ['all', 'articles']) && $posts)
                <div class="space-y-12">
                    @foreach($posts as $post)
                    <article class="group">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div
                                class="w-full md:w-64 h-48 flex-shrink-0 overflow-hidden rounded-lg border border-outline-variant">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $post->title }}" src="{{ $post->thumbnail_url }}" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="flex items-center gap-2 mb-3">
                                    @if($post->category)
                                    <span
                                        class="bg-primary-fixed text-on-primary-fixed text-metadata font-metadata px-2 py-0.5 rounded">
                                        {{ $post->category->name }}
                                    </span>
                                    @endif
                                    <span class="text-metadata font-metadata text-secondary">{{ $post->read_time }} min
                                        read</span>
                                </div>
                                <h2
                                    class="font-headline-md text-headline-md text-on-surface mb-3 group-hover:text-primary transition-colors">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="font-body-md text-body-md text-on-surface-variant mb-4 line-clamp-2">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 150) }}
                                </p>
                                <div class="flex items-center gap-3">
                                    <img alt="{{ $post->user->name }}" class="w-6 h-6 rounded-full object-cover"
                                        src="{{ $post->user->avatar_url }}" />
                                    <span
                                        class="text-metadata font-metadata text-on-surface font-semibold">{{ $post->user->name }}</span>
                                    <span class="text-metadata font-metadata text-secondary">•
                                        {{ $post->publish_time->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    @if(!$loop->last)
                    <!-- Divider -->
                    <div class="border-t border-outline-variant opacity-50"></div>
                    @endif
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $posts->links() }}
                </div>
                @endif

                <!-- Authors Results -->
                @if($type === 'authors' && $authors)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($authors as $author)
                    <div
                        class="flex items-center justify-between p-6 bg-surface-container-low rounded-xl border border-outline-variant/50">
                        <div class="flex items-center gap-4">
                            <img alt="{{ $author->name }}" class="w-12 h-12 rounded-full object-cover"
                                src="{{ $author->avatar_url }}" />
                            <div>
                                <h3 class="font-ui-label text-ui-label text-on-surface font-bold">{{ $author->name }}
                                </h3>
                                <p class="text-metadata font-metadata text-secondary">{{ $author->posts_count }}
                                    {{ Str::plural('article', $author->posts_count) }}</p>
                            </div>
                        </div>
                        <x-follow-button :user="$author" :following="(bool) $author->followers_exists" />
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $authors->links() }}
                </div>
                @endif

                <!-- Tags Results -->
                @if($type === 'tags' && $tags)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($tags as $tag)
                    <a href="{{ route('search', ['q' => $tag->name, 'type' => 'all']) }}"
                        class="p-6 bg-surface-container-low border border-outline-variant/50 rounded-xl hover:border-primary hover:text-primary transition-all text-center">
                        <span
                            class="block font-headline-md text-headline-md font-semibold text-on-surface group-hover:text-primary mb-1">#{{ $tag->name }}</span>
                        <span class="text-metadata font-metadata text-secondary">{{ $tag->posts_count }}
                            {{ Str::plural('article', $tag->posts_count) }}</span>
                    </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $tags->links() }}
                </div>
                @endif
                @endif
            </div>

            <!-- Sidebar Section -->
            <aside class="md:col-span-4 space-y-12">
                <!-- Top Authors -->
                <section>
                    <h3
                        class="font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider mb-6 pb-2 border-b border-outline">
                        Top Authors
                    </h3>
                    <div class="space-y-6">
                        @foreach($topAuthors as $author)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img alt="{{ $author->name }}"
                                    class="w-10 h-10 rounded-full bg-surface-container-high object-cover"
                                    src="{{ $author->avatar_url }}" />
                                <div>
                                    <p class="font-ui-label text-ui-label text-on-surface font-bold">{{ $author->name }}
                                    </p>
                                    <p class="text-metadata font-metadata text-secondary">{{ $author->posts_count }}
                                        {{ Str::plural('article', $author->posts_count) }}</p>
                                </div>
                            </div>
                            <x-follow-button :user="$author" :following="(bool) $author->followers_exists" variant="text" />
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Related Tags -->
                <section>
                    <h3
                        class="font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider mb-6 pb-2 border-b border-outline">
                        Related Tags
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($relatedTags as $tag)
                        <a class="px-4 py-2 bg-surface-container-low border border-outline-variant rounded-full text-ui-label font-ui-label text-on-surface-variant hover:border-primary hover:text-primary transition-all"
                            href="{{ route('search', ['q' => $tag->name, 'type' => 'all']) }}">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </section>

                <!-- Newsletter Card -->
                <section class="bg-primary-container p-8 rounded-lg text-on-primary">
                    <h3 class="font-headline-md text-headline-md mb-4 leading-tight">Master the Art of Focus.</h3>
                    <p class="font-body-md text-body-md opacity-90 mb-6">Join 15,000+ creators receiving our weekly
                        editorial on design and deep work.</p>
                    <div class="space-y-3">
                        <input
                            class="w-full px-4 py-3 rounded border-none text-on-surface font-ui-label focus:ring-2 focus:ring-on-primary-container text-black placeholder-gray-500"
                            placeholder="Email address" type="email" />
                        <button
                            class="w-full py-3 bg-on-surface text-white font-ui-button text-ui-button rounded hover:bg-opacity-90 transition-colors">
                            Subscribe Now
                        </button>
                    </div>
                </section>
            </aside>
        </div>
    </main>
</x-layout>