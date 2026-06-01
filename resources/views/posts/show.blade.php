<x-layout title="{{ $post->title }}">

    <main class="pt-24 pb-section-gap">
        <article class="mx-auto article-column px-margin-mobile md:px-0">
            <!-- Headline -->
            <header class="mb-12">
                <h1 class="font-display-lg text-display-lg mb-8 text-on-surface">{{ $post->title }}</h1>
                <!-- Author Bio -->
                <div class="flex items-center justify-between py-6 border-y border-outline-variant">
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full grayscale"
                            data-alt="A close-up portrait of a thoughtful writer in a minimalist studio setting. The lighting is soft and directional, creating a gentle chiaroscuro effect. The image is rendered in a premium black and white style to match the editorial and high-contrast digital quiet aesthetic."
                            src="{{ $post->thumbnail_url }}" />
                        <div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="font-ui-label text-ui-label font-bold text-on-surface">{{ $post->user->name }}</span>
                                <span class="text-secondary-fixed-dim">•</span>
                                <button
                                    class="text-primary font-ui-label text-ui-label font-semibold hover:underline">Follow</button>
                            </div>
                            <p class="font-metadata text-metadata text-secondary">{{ $post->created_at }} · 12 min read
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="material-symbols-outlined text-secondary hover:text-primary transition-colors">share</button>
                        <button
                            class="material-symbols-outlined text-secondary hover:text-primary transition-colors">more_horiz</button>
                    </div>
                </div>
            </header>
            <!-- Content -->
            <div class="space-y-8">
                {!! $post->content !!}
            </div>
        </article>
    </main>
    <!-- Floating Engagement Bar -->
    <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-40">
        <div
            class="flex items-center gap-6 px-6 py-3 bg-white rounded-full border border-outline-variant shadow-[0_20px_30px_rgba(26,26,26,0.05)] backdrop-blur-sm">
            <div class="flex items-center gap-2 group cursor-pointer">
                <span
                    class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">favorite</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">1.2k</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
            <div class="flex items-center gap-2 group cursor-pointer">
                <span
                    class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chat_bubble</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">84</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
            <button
                class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">bookmark</button>
            <button
                class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">ios_share</button>
        </div>
    </div>
</x-layout>