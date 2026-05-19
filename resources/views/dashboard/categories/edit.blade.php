<x-layout title="Edit Category">
    <main class="pt-24 pb-section-gap px-gutter max-w-container-max mx-auto">
        <div class="max-w-xl mx-auto bg-surface-container-lowest border border-outline-variant rounded-xl p-8 shadow-sm">
            <div class="mb-6 border-b border-outline-variant pb-4">
                <h2 class="font-headline-md text-2xl font-bold text-on-surface">Edit Category: {{ $category->name }}</h2>
                <p class="font-metadata text-metadata text-on-surface-variant mt-1">Modify the properties and taxonomy relations for this category.</p>
            </div>

            <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <div>
                    <label for="name" class="block font-ui-label text-ui-label font-semibold text-on-surface mb-2">Category Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $category->name) }}"
                           class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 font-ui-label text-ui-label focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('name') border-error @enderror"
                           required>
                    @error('name')
                    <p class="text-error text-xs mt-1 font-metadata">{{ $message }}</p>
                    @enderror
                </div>

{{--                <div>--}}
{{--                    <label for="slug" class="block font-ui-label text-ui-label font-semibold text-on-surface mb-2">Slug (URL-friendly)</label>--}}
{{--                    <input type="text"--}}
{{--                           name="slug"--}}
{{--                           id="slug"--}}
{{--                           value="{{ old('slug', $category->slug) }}"--}}
{{--                           class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 font-ui-label text-ui-label focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('slug') border-error @enderror"--}}
{{--                           required>--}}
{{--                    @error('slug')--}}
{{--                    <p class="text-error text-xs mt-1 font-metadata">{{ $message }}</p>--}}
{{--                    @enderror--}}
{{--                </div>--}}

                <div>
                    <label for="parent_id" class="block font-ui-label text-ui-label font-semibold text-on-surface mb-2">Parent Category (Optional)</label>
                    <select name="parent_id"
                            id="parent_id"
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 font-ui-label text-ui-label focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">None (Main Category)</option>
                        @foreach($parentCategories as $parent)
                            @if($parent->id !== $category->id)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block font-ui-label text-ui-label font-semibold text-on-surface mb-2">Description</label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 font-ui-label text-ui-label focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('description') border-error @enderror"
                              placeholder="Describe the category...">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                    <p class="text-error text-xs mt-1 font-metadata">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-outline-variant">
                    <a href="{{ route('dashboard.categories.index') }}"
                       class="px-5 py-3 border border-outline-variant rounded-lg font-ui-button text-ui-label text-on-surface-variant hover:bg-surface-container transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 active:scale-95 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit_note</span>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layout>
