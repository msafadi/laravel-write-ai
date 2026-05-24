    <x-layout>
        <main class="pt-24 pb-section-gap px-gutter max-w-container-max mx-auto">
            <!-- Header Section -->
            <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div class="max-w-2xl">
                    <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Category Management</h1>
                    <p class="font-body-md text-on-surface-variant">Organize your content structure, monitor performance
                        metrics, and refine your editorial taxonomy for maximum audience engagement.</p>
                </div>
                <a href="{{ route('dashboard.categories.create') }}"
                    class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 active:scale-95 transition-all flex items-center gap-2 whitespace-nowrap">
                    <span class="material-symbols-outlined">add</span>
                    Create Category
                </a>
            </header>
            <!-- Search and Layout Toggle -->
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-8">
                <div class="relative w-full md:w-96">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl pl-12 pr-4 py-3 font-ui-label text-ui-label focus:border-primary outline-none transition-all"
                        placeholder="Filter categories by name..." type="text" />
                </div>
                <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-lg">
                    <button class="p-2 bg-surface-container-lowest text-primary rounded shadow-sm">
                        <span class="material-symbols-outlined">grid_view</span>
                    </button>
                    <button class="p-2 text-on-surface-variant">
                        <span class="material-symbols-outlined">list</span>
                    </button>
                </div>
            </div>
            <!-- dashboard. Grid (Asymmetric Bento-inspired layout) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                @foreach ($categories->take(4) as $category)
                    @if ($loop->first)
                        <div
                            class="md:col-span-8 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 hover:border-primary transition-colors group relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110">
                            </div>
                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <span
                                            class="text-primary font-bold text-sm tracking-widest uppercase mb-2 block">Top
                                            Performing</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface">
                                            {{ $category->name }}
                                        </h2>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                            class="p-2 hover:bg-surface-variant rounded transition-colors text-on-surface-variant"
                                            title="Edit">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <form action="{{ route('dashboard.categories.archive', $category->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="p-2 hover:bg-surface-variant rounded transition-colors text-on-surface-variant"
                                                title="Archive">
                                                <span class="material-symbols-outlined">archive</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                                    <div>
                                        <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">
                                            Posts
                                        </p>
                                        <p class="font-headline-md text-2xl font-bold">{{ $category->post_count }}</p>
                                    </div>
                                    <div>
                                        <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">
                                            Views
                                        </p>
                                        <p class="font-headline-md text-2xl font-bold">
                                            {{ number_format($category->total_views / 1000, 1) }}k</p>
                                    </div>
                                    <div>
                                        <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">
                                            Avg.
                                            Read</p>
                                        <p class="font-headline-md text-2xl font-bold">4:12</p>
                                    </div>
                                    <div>
                                        <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">
                                            Growth
                                        </p>
                                        <p class="font-headline-md text-2xl font-bold text-green-600">+12%</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 pt-6 border-t border-outline-variant">
                                    <span class="font-ui-label text-ui-label text-on-surface-variant">Active since Jan
                                        2023</span>
                                    <div class="ml-auto flex -space-x-2">
                                        <img alt="Author 1" class="w-8 h-8 rounded-full border-2 border-white"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAM9W2eat990-MVuNeIYffYl4uCTjTXoTDfCkm5YnoYgLGGNItf3ZFWbIiI4zlndiQrKTpdrxEGvYPWzKXLlQjL4wehIr42eJOSPixKXqeXoC_V4Z1_aF_KwtpRsbbO0d44KWWjd7HzAcTDucldNYNk4uENBOPiawr5b7k3Bu8H23jXPWJ9cTTe7tUVE59NUNvop508ThgZtWAQEJpIRLtOn6sR3fnH1kiu27bo1DSwMu-hI32iO6u4hysa1hj9C-za6Iyt2s_SmU5P" />
                                        <img alt="Author 2" class="w-8 h-8 rounded-full border-2 border-white"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKPJgbkFGxKR0m2d-FErVkoDZOyPahRJUhk38XNvW-COCnYhQuHoUpWWzxZlx4Yw_MKRQv-hBWa7wJnzmnsEnzxxiEDlo8D6Nix9Dz86IkszKqGvpPnmKWEIPfpwRItcrXviKGnvHoTOgsiwyZ2q0eY4Y39ASefgoNHJQ8V216woNYM9USWNth_kx-qF-Ce4EHb-zJwJjmz2CCPwcJOYLZkVHmc3Gier99MXbC6G-k7YbskMfc25a8mBGo_4ZvZptyzFASnYistu5l" />
                                        <img alt="Author 3" class="w-8 h-8 rounded-full border-2 border-white"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiwTDaFlut3XFfRu1Q1m515KiFGoWnhCSo3OXJnC4SmXhP1YJGFBVII95SR0vkGagyqbj-PyeyJgGOkKt3NRE3YyO6CFZaF58p_bbwT8jHeW3A9CmlBr_Eyw2PU_Urg9DfRSJXpCcoAzCykr9ChjXiu32mZOSgGyqC-saZTPO6M0RsV-M2oID969jcz852HptuijLLHM6B81bOv1K452v_0fvyhmrk-rOUvuOYsTeLOwFt0omuRE-AFNxA22JFM-z5JfdFkJp1fB-m" />
                                        <div
                                            class="w-8 h-8 rounded-full bg-surface-container border-2 border-white flex items-center justify-center font-metadata text-metadata">
                                            +8</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($loop->iteration <= 3)
                        <div
                            class="md:col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 hover:border-primary transition-colors flex flex-col justify-between{{ $loop->iteration === 3 ? ' group' : '' }}">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <h2 class="font-headline-md text-2xl font-bold text-on-surface">
                                        {{ $category->name }}
                                    </h2>
                                    <button
                                        class="p-2 hover:bg-surface-variant rounded transition-colors text-on-surface-variant">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                </div>
                                <p class="font-body-md text-on-surface-variant text-base mb-6">
                                    {{ $category->description }}
                                </p>

                            </div>
                            <div class="flex items-center gap-6">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="material-symbols-outlined text-on-surface-variant text-sm">article</span>
                                    <span class="font-ui-label text-ui-label">{{ $category->post_count }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="material-symbols-outlined text-on-surface-variant text-sm">visibility</span>
                                    <span
                                        class="font-ui-label text-ui-label">{{ number_format($category->total_views / 1000, 1) }}k</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <a href="{{ route('dashboard.categories.create') }} "
                    class="md:col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 border-dashed flex flex-col items-center justify-center text-center opacity-60 hover:opacity-100 hover:bg-surface transition-all cursor-pointer">
                    <div
                        class="w-12 h-12 rounded-full border border-outline-variant flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-on-surface-variant">add</span>
                    </div>
                    <p class="font-ui-label text-ui-label">Add Category Idea</p>
                    <p class="font-metadata text-metadata text-on-surface-variant mt-1">Draft a new category skeleton
                    </p>
                </a>
            </div>
            <!-- Table View For Bulk Actions (Secondary Section) -->
            <section class="mt-20">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-8">All Categories</h3>
                <div class="overflow-x-auto bg-surface-container-lowest border border-outline-variant rounded-xl">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant">
                                <th
                                    class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                    Category Name</th>
                                <th
                                    class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                    Post Count</th>
                                <th
                                    class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                    Total Views</th>
                                <th
                                    class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-surface transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-headline-md text-xl font-bold">{{ $category->name }}
                                        </div>
                                        <div class="font-metadata text-metadata text-on-surface-variant">
                                            /categories/{{ $category->slug }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($category->status === 'active')
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">
                                                {{ ucfirst($category->status) }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-surface-container-highest text-secondary rounded text-xs font-bold">{{ ucfirst($category->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-ui-label text-ui-label">
                                        {{ $category->post_count }}</td>
                                    <td class="px-6 py-4 font-ui-label text-ui-label">
                                        {{ number_format($category->total_views / 1000, 1) }}K</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            @if ($category->status === 'active')
                                                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                    class="text-on-surface-variant hover:text-primary"><span
                                                        class="material-symbols-outlined">edit</span></a>
                                                <form
                                                    action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-on-surface-variant hover:text-error">
                                                        <span class="material-symbols-outlined">delete</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('dashboard.categories.activate', $category->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="text-on-surface-variant hover:text-primary bg-transparent border-0 p-0">
                                                        <span class="material-symbols-outlined">unarchive</span>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-on-surface-variant hover:text-error">
                                                        <span class="material-symbols-outlined">delete</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </section>
        </main>
        <!-- Footer -->
        <footer class="bg-surface border-t border-outline-variant mt-20">
            <div
                class="w-full py-section-gap px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col items-center md:items-start gap-2">
                    <span class="font-headline-md text-headline-md text-on-surface">Ink &amp; Paper</span>
                    <p class="font-metadata text-metadata text-secondary">© 2024 Ink &amp; Paper Platform. All rights
                        reserved.</p>
                </div>
                <div class="flex gap-8">
                    <a class="font-body-md text-body-md text-secondary hover:text-on-surface hover:underline transition-all"
                        href="#">About</a>
                    <a class="font-body-md text-body-md text-secondary hover:text-on-surface hover:underline transition-all"
                        href="#">Privacy</a>
                    <a class="font-body-md text-body-md text-secondary hover:text-on-surface hover:underline transition-all"
                        href="#">Terms</a>
                    <a class="font-body-md text-body-md text-secondary hover:text-on-surface hover:underline transition-all"
                        href="#">API</a>
                    <a class="font-body-md text-body-md text-secondary hover:text-on-surface hover:underline transition-all"
                        href="#">Help</a>
                </div>
                <div class="flex gap-4">
                    <button
                        class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-full hover:bg-primary hover:text-on-primary transition-all focus:outline-none ring-2 ring-primary">
                        <span class="material-symbols-outlined text-sm">mail</span>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-full hover:bg-primary hover:text-on-primary transition-all focus:outline-none ring-2 ring-primary">
                        <span class="material-symbols-outlined text-sm">share</span>
                    </button>
                </div>
            </div>
        </footer>
    </x-layout>
