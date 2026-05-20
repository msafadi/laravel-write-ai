<x-layout title="Create Category">
    <!-- Main Content Shell -->

    <main class="pt-24 min-h-screen py-16 px-gutter">
        <div class="max-w-article-max mx-auto">
            <!-- Header Section -->
            <header class="mb-12">
                <nav class="flex items-center gap-2 text-metadata font-metadata text-secondary mb-4">
                    <a class="hover:text-primary" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]" data-icon="chevron_right">chevron_right</span>
                    <a class="hover:text-primary" href="{{ route('dashboard.categories.index') }}">Categories</a>
                    <span class="material-symbols-outlined text-[14px]" data-icon="chevron_right">chevron_right</span>
                    <span class="text-on-surface font-medium">New Category</span>
                </nav>
                <h1 class="font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface mb-2">Create
                    Category</h1>
                <p class="text-secondary font-body-md">Organize your publications and help readers discover your best
                    work.</p>
            </header>
            <!-- Form Container -->
            <form action="{{ $action ?? route('dashboard.categories.store') }}" method="POST" class="space-y-10"
                id="categoryForm">
                @csrf
                @method($method ?? 'POST')

                <section class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-6">Basic Information</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Category Name -->
                        <div class="flex flex-col gap-2">
                            <label class="font-ui-label text-ui-label text-on-surface" for="categoryName">Category
                                Name</label>
                            <input
                                class="bg-surface border border-outline-variant rounded-lg p-3 text-body-md font-ui-label text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-secondary-fixed-dim"
                                id="categoryName" name="name" value="{{ $category->name ?? '' }}"
                                placeholder="e.g., Engineering &amp; Systems" type="text" />
                        </div>
                        <!-- Slug -->
                        <div class="flex flex-col gap-2">
                            <label class="font-ui-label text-ui-label text-on-surface flex items-center gap-2"
                                for="categorySlug">
                                Slug
                                <span class="material-symbols-outlined text-[16px] text-secondary" data-icon="info"
                                    title="The URL-friendly version of the name.">info</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="absolute left-3 text-secondary-fixed-dim font-ui-label text-ui-label">ink-paper.com/</span>
                                <input
                                    class="w-full bg-surface border border-outline-variant rounded-lg p-3 pl-28 text-body-md font-ui-label text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                    id="categorySlug" name="slug" value="{{ $category->slug ?? '' }}"
                                    placeholder="engineering-systems" type="text" />
                            </div>
                        </div>
                        <!-- Parent Category -->
                        <div class="flex flex-col gap-2">
                            <label class="font-ui-label text-ui-label text-on-surface" for="parentCategory">Parent
                                Category</label>
                            <div class="relative">
                                <select
                                    class="w-full bg-surface border border-outline-variant rounded-lg p-3 pr-10 text-body-md font-ui-label text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all appearance-none"
                                    id="parentCategory" name="parent_id">
                                    <option value="">None (Top Level)</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                             {{ ($category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-secondary"
                                    data-icon="expand_more">expand_more</span>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="flex flex-col gap-2">
                            <label class="font-ui-label text-ui-label text-on-surface"
                                for="categoryDesc">Description</label>
                            <textarea
                                class="bg-surface border border-outline-variant rounded-lg p-3 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all resize-none placeholder:text-secondary-fixed-dim"
                                id="categoryDesc" name="description"
                                placeholder="Describe what this category is about..." rows="4">{{ $category->description ?? '' }}</textarea>
                        </div>
                    </div>
                </section>
                <!-- Action Buttons -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-8 border-t border-outline-variant">
                    {{-- <button
                        class="w-full sm:w-auto px-8 py-3 rounded-lg border border-on-background font-ui-button text-ui-button text-on-background hover:bg-surface-container-high transition-all active:scale-95"
                        type="button">
                        Cancel
                    </button> --}}
                    <button
                        class="w-full sm:w-auto px-10 py-3 rounded-lg bg-primary-container text-on-primary font-ui-button text-ui-button shadow-lg shadow-primary/20 hover:brightness-110 transition-all active:scale-95"
                        type="submit">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layout>
