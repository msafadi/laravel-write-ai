<x-layout title="{{ $category->name }}">
    <main class="pt-24 pb-section-gap px-gutter max-w-container-max mx-auto">
        <nav class="flex items-center gap-2 text-sm font-ui-label text-on-surface-variant mb-4">
            <a href="{{ route('dashboard.categories.index') }}" class="hover:text-primary transition-colors">Categories</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-on-surface font-semibold">{{ $category->name }}</span>
        </nav>

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-outline-variant pb-6">
            <div class="max-w-2xl">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="font-display-lg text-4xl md:text-5xl text-on-surface font-bold">{{ $category->name }}</h1>
                    @if($category->parent)
                        <span class="px-2.5 py-1 bg-surface-container-low text-on-surface-variant rounded-full text-xs font-ui-label">
                            Sub-category of: <strong>{{ $category->parent->name }}</strong>
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-primary/10 text-primary rounded-full text-xs font-ui-label font-bold">
                            Main Category
                        </span>
                    @endif
                </div>
                <p class="font-metadata text-sm text-on-surface-variant mb-3">Slug: <code class="bg-surface-container-low px-1.5 py-0.5 rounded text-primary font-mono text-xs">/categories/{{ $category->slug }}</code></p>
                <p class="font-body-md text-on-surface-variant text-lg leading-relaxed">{{ $category->description ?? 'No description provided for this category.' }}</p>
            </div>

            <div class="flex items-center gap-3 whitespace-nowrap">
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="border border-outline-variant text-on-surface-variant px-5 py-2.5 rounded-lg font-ui-button text-sm hover:bg-surface-container-low transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">edit</span>
                    Edit
                </a>
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? All related content might be affected.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-error/30 text-error px-5 py-2.5 rounded-lg font-ui-button text-sm hover:bg-error/5 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">delete</span>
                        Delete
                    </button>
                </form>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">article</span>
                </div>
                <div>
                    <p class="font-metadata text-xs text-on-surface-variant uppercase tracking-wider mb-0.5">Total Posts</p>
                    <p class="font-ui-label text-2xl font-bold">{{ $category->posts_count ?? $posts->total() }}</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 bg-surface-container-low text-on-surface-variant rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">calendar_today</span>
                </div>
                <div>
                    <p class="font-metadata text-xs text-on-surface-variant uppercase tracking-wider mb-0.5">Setup Date</p>
                    <p class="font-ui-label text-base font-bold">{{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 bg-surface-container-low text-on-surface-variant rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">account_tree</span>
                </div>
                <div>
                    <p class="font-metadata text-xs text-on-surface-variant uppercase tracking-wider mb-0.5">Sub-Categories</p>
                    <p class="font-ui-label text-2xl font-bold">{{ $subCategories->count() }}</p>
                </div>
            </div>
        </div>

        @if($subCategories->isNotEmpty())
            <section class="mb-12">
                <h3 class="font-headline-md text-xl font-bold text-on-surface mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-primary">subdirectory_arrow_right</span>
                    Sub-categories under {{ $category->name }}
                </h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($subCategories as $sub)
                        <a href="{{ route('categories.show', $sub->id) }}" class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 hover:border-primary hover:text-primary transition-colors text-sm font-ui-label shadow-sm flex items-center gap-2">
                            <span>{{ $sub->name }}</span>
                            <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <section>
            <h3 class="font-headline-md text-2xl text-on-surface mb-6">Articles in this Category</h3>

            <div class="overflow-x-auto bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant">
                        <th class="px-6 py-4 font-ui-label text-xs font-bold text-on-surface uppercase tracking-wider">Article Title</th>
                        <th class="px-6 py-4 font-ui-label text-xs font-bold text-on-surface uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 font-ui-label text-xs font-bold text-on-surface uppercase tracking-wider">Publish Date</th>
                        <th class="px-6 py-4 font-ui-label text-xs font-bold text-on-surface uppercase tracking-wider text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                    @forelse($posts as $post)
                        <tr class="hover:bg-surface transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-ui-label text-base font-bold text-on-surface hover:text-primary transition-colors">
                                    <a href="#">{{ $post->title }}</a>
                                </div>
                                <div class="font-metadata text-xs text-on-surface-variant mt-0.5">
                                    By: {{ $post->user->name ?? 'Unknown Author' }} | Slug: /posts/{{ $post->slug }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if(($post->status ?? 'published') === 'published')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold font-ui-label">Published</span>
                                @else
                                    <span class="px-2 py-1 bg-surface-container-low text-secondary rounded text-xs font-bold font-ui-label">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-metadata text-sm text-on-surface-variant">
                                {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="#" class="text-on-surface-variant hover:text-primary transition-colors" title="View Article">
                                        <span class="material-symbols-outlined text-xl">visibility</span>
                                    </a>
                                    <a href="#" class="text-on-surface-variant hover:text-primary transition-colors" title="Edit Article">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant font-body-md">
                                <span class="material-symbols-outlined text-4xl block text-outline mb-2">article_off</span>
                                No articles have been assigned to this category yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 font-ui-label">
                {{ $posts->links() }}
            </div>
        </section>

    </main>
</x-layout>
