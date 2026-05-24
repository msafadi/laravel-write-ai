<form action="{{ $action ?? route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <main class="pt-24 pb-32 flex flex-col md:flex-row max-w-container-max mx-auto px-gutter gap-12">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full distraction-free-focus">
            <div class="editor-container">
                @if ($errors->any())
                    <div class="text-red-800 mb-4 border border-red-900 bg-red-300">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
                <!-- Title Field -->
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full bg-transparent border-none focus:ring-0 font-display-lg text-display-lg resize-none placeholder:text-surface-variant text-on-surface mb-8 overflow-hidden"
                    placeholder="Enter your title...">
                @error('title')
                    <p class="text-red-800">{{ $message }}</p>
                @enderror
                <!-- Floating Toolbar (Contextual) -->
                {{-- 
                <div class="sticky top-20 z-40 flex justify-center mb-12">
                    <div
                        class="bg-inverse-surface text-inverse-on-surface px-2 py-1.5 rounded-xl shadow-xl flex items-center gap-1 border border-outline/20">
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Bold">
                            <span class="material-symbols-outlined">format_bold</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Italic">
                            <span class="material-symbols-outlined">format_italic</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 1">
                            <span class="material-symbols-outlined">format_h1</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 2">
                            <span class="material-symbols-outlined">format_h2</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Quote">
                            <span class="material-symbols-outlined">format_quote</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Link">
                            <span class="material-symbols-outlined">link</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Image">
                            <span class="material-symbols-outlined">image</span>
                        </button>
                    </div>
                </div>
                <!-- Main Content Editor -->
                <div class="w-full min-h-[614px] bg-transparent border-none focus:outline-none font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    contenteditable="true" data-placeholder="Type your story...">
                    <p class="mb-6">It began as a simple thought—a flicker of ink on a pristine digital canvas. The
                        rhythm of the keys creates a cadence, a quiet symphony of creation that exists only between the
                        writer and the paper.</p>
                    <p class="mb-6">In this space, distraction falls away. The borders of the interface recede, leaving
                        only the words. We prioritize clarity above all else, ensuring that every sentence has room to
                        breathe and every idea has the weight it deserves.</p>
                </div>
                --}}
                <textarea name="content"
                    class="w-full bg-transparent border-none focus:ring-0 font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    data-placeholder="Type your story..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-800">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label hover:bg-primary-hover transition-colors">
                Publish
            </button>
        </div>
        <!-- Sidebar: Publishing Settings -->
        <aside
            class="hidden lg:block w-80 shrink-0 h-fit sticky top-24 sidebar-overlay transition-opacity duration-500">
            <div class="space-y-8 border-l border-outline-variant pl-8">
                <!-- Cover Image -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Cover
                        Image
                    </h3>
                    @if ($post->cover_image)
                        <div class="aspect-video w-full rounded-lg bg-cover bg-center mb-4"
                            style="background-image: url('{{ asset('storage/' . $post->cover_image) }}')"></div>
                    @else
                        <div
                            class="aspect-video w-full rounded-lg bg-surface-container border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-surface-container-high transition-colors group">
                            <span
                                class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors">add_a_photo</span>
                            <span class="font-metadata text-metadata text-secondary">Upload high-res photo</span>
                        </div>
                    @endif
                    <input type="file" name="cover" />
                    @error('cover')
                        @foreach ($errors->get('cover') as $error)
                            <p class="text-red-800">{{ $error }}</p>
                        @endforeach
                    @enderror
                </section>
                <!-- Categories (searchable, multi-select) -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Categories
                    </h3>
                    <div id="selected_categories" class="flex flex-wrap gap-2 mb-3">
                        @foreach (old('category_ids', $selectedCategories ?? []) as $c)
                            @if (is_array($c))
                                <span
                                    class="category-chip bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-2"
                                    data-id="{{ $c['id'] }}">{{ $c['name'] }} <button type="button"
                                        class="ml-1 remove-category">×</button></span>
                                <input type="hidden" name="category_ids[]" value="{{ $c['id'] }}" />
                            @else
                                @php
                                    // when old input gives id list, try to resolve names via Category model
                                    $cat = \App\Models\Category::find($c);
                                @endphp
                                @if ($cat)
                                    <span
                                        class="category-chip bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-2"
                                        data-id="{{ $cat->id }}">{{ $cat->name }} <button type="button"
                                            class="ml-1 remove-category">×</button></span>
                                    <input type="hidden" name="category_ids[]" value="{{ $cat->id }}" />
                                @endif
                            @endif
                        @endforeach
                    </div>

                    <input type="text" id="category_search" autocomplete="off" value=""
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all"
                        placeholder="Search categories and press enter or click to add..." />
                    <ul id="category_suggestions"
                        class="mt-1 bg-surface-container rounded shadow-sm max-h-48 overflow-auto"></ul>
                </section>
                <!-- (Removed Tags: categories now act as tags) -->
                <!-- SEO Preview -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-ui-label text-ui-label text-on-surface uppercase tracking-wider">SEO Preview
                        </h3>
                        <button class="text-primary font-metadata text-metadata hover:underline">Edit</button>
                    </div>
                    <div class="p-4 bg-white border border-outline-variant rounded-lg shadow-sm">
                        <div class="text-[#1a0dab] font-sans text-[18px] leading-tight mb-1 truncate">The Art of
                            Digital
                            Quiet | Ink &amp; Paper</div>
                        <div class="text-[#006621] font-sans text-[14px] mb-1 truncate">inkandpaper.com/art-of-quiet
                        </div>
                        <p class="text-secondary font-sans text-[13px] line-clamp-2">Discover how a distraction-free
                            writing environment can transform your creative process and help you find your voice in
                            a
                            noisy world...</p>
                    </div>
                </section>
                <!-- Visibility -->
                <section class="pt-4 border-t border-outline-variant">
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span
                            class="font-ui-label text-ui-label text-secondary group-hover:text-on-surface transition-colors">Public
                            Post</span>
                        <div class="relative inline-flex items-center">
                            <input checked="" class="sr-only peer" type="checkbox" />
                            <div
                                class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </div>
                    </label>
                </section>
            </div>
        </aside>

    </main>
    <script>
        (function() {
            const input = document.getElementById('category_search');
            const list = document.getElementById('category_suggestions');
            const selectedContainer = document.getElementById('selected_categories');
            if (!input || !list || !selectedContainer) return;

            let timer = null;
            const url = "{{ route('dashboard.categories.search') }}";

            function createHiddenInput(id) {
                const inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = 'category_ids[]';
                inp.value = id;
                return inp;
            }

            function addCategory(id, name) {
                // avoid duplicates
                if (selectedContainer.querySelector(`[data-id="${id}"]`)) return;

                const chip = document.createElement('span');
                chip.className =
                    'category-chip bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-2';
                chip.dataset.id = id;
                chip.innerHTML = `${name} <button type="button" class="ml-1 remove-category">×</button>`;

                selectedContainer.appendChild(chip);
                selectedContainer.appendChild(createHiddenInput(id));
            }

            // suggestion fetch (debounced)
            function fetchSuggestions(q) {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetch(url + (q ? '?q=' + encodeURIComponent(q) : ''))
                        .then(r => r.json())
                        .then(data => {
                            list.innerHTML = data.map(cat =>
                                `<li data-id="${cat.id}" class="px-3 py-2 hover:bg-surface-container cursor-pointer">${cat.name}</li>`
                            ).join('');
                        })
                        .catch(() => list.innerHTML = '');
                }, 200);
            }

            input.addEventListener('input', (e) => {
                const q = e.target.value.trim();
                fetchSuggestions(q);
            });

            // show top 5 when input focused and empty
            input.addEventListener('focus', () => {
                const q = input.value.trim();
                fetchSuggestions(q);
            });

            // click suggestion -> add
            list.addEventListener('click', (e) => {
                const li = e.target.closest('li');
                if (!li) return;
                addCategory(li.dataset.id, li.textContent.trim());
                input.value = '';
                list.innerHTML = '';
                input.focus();
            });

            // enter to add first suggestion if present
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const first = list.querySelector('li');
                    if (first) {
                        addCategory(first.dataset.id, first.textContent.trim());
                        input.value = '';
                        list.innerHTML = '';
                    }
                }
            });

            // remove chip
            selectedContainer.addEventListener('click', (e) => {
                const btn = e.target.closest('.remove-category');
                if (!btn) return;
                const chip = btn.closest('[data-id]');
                if (!chip) return;
                const id = chip.dataset.id;
                // remove hidden input
                const hidden = selectedContainer.querySelector(`input[name="category_ids[]"][value="${id}"]`);
                if (hidden) hidden.remove();
                chip.remove();
            });

            // close suggestions on outside click
            document.addEventListener('click', (e) => {
                if (!e.target.closest('#category_search') && !e.target.closest('#category_suggestions')) {
                    list.innerHTML = '';
                }
            });
        })();
    </script>
</form>
