<x-layout title="Category Details">
    <main class="pt-24 pb-32 px-gutter max-w-container-max mx-auto">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('dashboard.categories.index') }}"
                class="inline-flex items-center gap-2 text-on-surface-variant hover:text-on-surface mb-8 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to Categories
            </a>

            <section class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-8 shadow-sm">
                <div class="flex items-start justify-between gap-6 mb-8">
                    <div>
                        <p class="text-metadata font-metadata uppercase tracking-wider text-primary mb-2">Category</p>
                        <h1 class="font-display-lg text-display-lg text-on-surface">{{ $category->name }}</h1>
                        <p class="text-on-surface-variant mt-3 max-w-2xl">{{ $category->description }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-metadata font-metadata uppercase tracking-wider text-on-surface-variant">Slug</p>
                        <p class="font-ui-label text-ui-label text-on-surface">{{ $category->slug }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="rounded-xl border border-outline-variant p-5">
                        <p class="text-metadata font-metadata uppercase tracking-wider text-on-surface-variant mb-2">
                            Category ID</p>
                        <p class="text-2xl font-bold text-on-surface">{{ $category->id }}</p>
                    </div>
                    <div class="rounded-xl border border-outline-variant p-5">
                        <p class="text-metadata font-metadata uppercase tracking-wider text-on-surface-variant mb-2">
                            Posts</p>
                        <p class="text-2xl font-bold text-on-surface">{{ $category->post_count }}</p>
                    </div>
                    <div class="rounded-xl border border-outline-variant p-5">
                        <p class="text-metadata font-metadata uppercase tracking-wider text-on-surface-variant mb-2">
                            Status</p>
                        <p class="text-2xl font-bold text-green-600">{{ ucfirst($category->status) }}</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout>
