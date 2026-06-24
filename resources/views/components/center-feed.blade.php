<section class="col-span-1 md:col-span-7 space-y-12">

    @if($featuredPost)
        <article class="group border border-outline-variant rounded-xl overflow-hidden bg-white hover:border-primary transition-colors duration-300">
            <div class="aspect-[16/9] overflow-hidden">
                <img alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     src="{{ $featuredPost->cover_image  }}" /> <!-- ? asset('storage/' . $featuredPost->cover_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBBFBSyj6CkyvBOD_SRQ5A-cSY1Cdw5WCfpcpMbK6wt1gNKpKVEBIHZC_rRMCEvC8iTE1zTEYRtsP81jrHP0bo9ffojhdYOzgAhgs1Cz0q8QFqa0nSD_IfSMhW9ztTCe15twvtGHZkIn0PtjzGAqIbQpqDXsAI-wV5oooi_CA4cwuHj96Y1K7UbHK1q_5sWUMDjows8tWRxj4iMYvIBUd-ops3T519EOJ6RlLxzk1jn0Wtk_8HWTjpj__S_xDppqNI1tnhqIX3QSUad' -->
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center gap-3 font-metadata text-metadata text-secondary">
                    <span class="bg-primary-container text-on-primary px-2 py-0.5 rounded font-bold uppercase tracking-wider">Featured</span>
                    <span>•</span>
                    <span>{{ $featuredPost->created_at->format('M d, Y') }}</span>
                    <span>•</span>
                    <span>{{ ceil(str_word_count(strip_tags($featuredPost->content)) / 200) }} min read</span>
                </div>
                <h2 class="font-headline-md text-headline-md text-on-surface leading-tight group-hover:text-primary transition-colors">
                    <a href="{{ route('posts.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                </h2>
                <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
                    {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                </p>
                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-surface-container border border-outline-variant overflow-hidden">
                            <img alt="{{ $featuredPost->user->name }}" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlYHQ2yPKl-Weyq3JRVjhy936Wd9AaAVvFRAHsIQrKrnCv4i5A-cQ6YF0zqrKz1Ma7N9cW9R6NimpSIUyDmkSyzdN0Sf4wwyS7Jf5Iq_UrWBpwB9MPN5QGbUNdxa82Mz2YU2I0GnXGjM6DDPi-mIODcm-LUOTsZb-C7V1GgUyP3AvuztsY0A5OKbR2TsqCVVxpF70-TiHMB2Jsyd2ojVnbA0gj9jJ03QY9BqD7puDZnBBYI5PyKBtwtQiGWMcknmNIjCWUWokSAMSR" />
                        </div>
                        <div>
                            <p class="font-ui-label text-ui-label font-bold text-on-surface">{{ $featuredPost->user->name }}</p>
                            <p class="font-metadata text-metadata text-secondary">Author</p>
                        </div>
                    </div>
                    <button class="text-primary p-2 rounded-full hover:bg-primary-container/10 transition-colors">
                        <span class="material-symbols-outlined">bookmark_add</span>
                    </button>
                </div>
            </div>
        </article>
    @endif

    <div class="grid grid-cols-1 gap-12">
        @forelse($posts as $post)
            <article class="flex flex-col md:flex-row gap-8 group">
                <div class="w-full md:w-1/3 aspect-video md:aspect-square overflow-hidden rounded-lg border border-outline-variant">
                    <img alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         src="{{ $post->cover_image }}" />
                </div>
                <div class="w-full md:w-2/3 space-y-3">
                    <div class="flex items-center gap-2 font-metadata text-metadata text-secondary">
                        <span class="text-primary font-bold">{{ $post->category?->name ?? 'General' }}</span>
                        <span>•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="font-headline-md text-[24px] leading-snug text-on-surface group-hover:text-primary transition-colors">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-on-surface-variant font-body-md text-body-md line-clamp-2">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <p class="font-ui-label text-ui-label text-on-surface font-medium">{{ $post->user->name }}</p>
                        <span class="text-secondary text-metadata">•</span>
                        <span class="text-secondary font-metadata text-metadata">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-center text-secondary py-8">No stories found.</p>
        @endforelse
    </div>

    @if($posts->hasMorePages())
        <div class="pt-8 flex justify-center">
            <a href="{{ $posts->nextPageUrl() }}"
               class="px-8 py-3 border border-primary text-primary font-ui-button text-ui-button rounded-lg hover:bg-primary-container/5 transition-all">
                Load More Stories
            </a>
        </div>
    @endif
</section>
