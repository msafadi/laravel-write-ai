<x-layout title="{{ $category->exists ? 'Edit Category' : 'Create Category' }}">
    <main class="pt-24 pb-32 px-gutter max-w-container-max mx-auto">
        <div class="max-w-3xl mx-auto">
            <div class="mb-10">
                <h1 class="font-display-lg text-display-lg text-on-surface mb-2">
                    {{ $category->exists ? 'Edit Category' : 'Create Category' }}
                </h1>
                <p class="text-on-surface-variant font-body-md">
                    {{ $category->exists
                        ? 'Update the category details and save your changes.'
                        : 'Add a new category to organize content in the dashboard.' }}
                </p>
            </div>

            <form
                action="{{ $category->exists ? route('dashboard.categories.update', $category->id) : route('dashboard.categories.store') }}"
                method="POST"
                class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-8 shadow-sm space-y-6">
                @csrf
                @if ($category->exists)
                    @method('PUT')
                @endif

                <div class="space-y-2">
                    <label for="name" class="block font-ui-label text-ui-label text-on-surface">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}"
                        class="w-full rounded-xl border border-outline-variant bg-white px-4 py-3 focus:border-primary focus:ring-primary"
                        placeholder="Enter category name">
                    @error('name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="description"
                        class="block font-ui-label text-ui-label text-on-surface">Description</label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full rounded-xl border border-outline-variant bg-white px-4 py-3 focus:border-primary focus:ring-primary"
                        placeholder="Describe this category">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="status" class="block font-ui-label text-ui-label text-on-surface">Status</label>
                        <select id="status" name="status"
                            class="w-full rounded-xl border border-outline-variant bg-white px-4 py-3 focus:border-primary focus:ring-primary">
                            <option value="draft" @selected(old('status', $category->exists ? $category->status : 'active') === 'draft')>Draft</option>
                            <option value="active" @selected(old('status', $category->exists ? $category->status : 'active') === 'active')>Active</option>
                            <option value="archived" @selected(old('status', $category->exists ? $category->status : 'active') === 'archived')>Archived</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="parent_id" class="block font-ui-label text-ui-label text-on-surface">Super
                            Category</label>
                        <select id="parent_id" name="parent_id"
                            class="w-full rounded-xl border border-outline-variant bg-white px-4 py-3 focus:border-primary focus:ring-primary">
                            <option value="">No super category</option>
                            @foreach ($superCategories as $superCategory)
                                <option value="{{ $superCategory->id }}" @selected((string) old('parent_id', $category->parent_id) === (string) $superCategory->id)>
                                    {{ $superCategory->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all">
                        {{ $category->exists ? 'Save Changes' : 'Create Category' }}
                    </button>
                    <a href="{{ route('dashboard.categories.index') }}"
                        class="px-6 py-3 rounded-lg font-ui-button text-ui-button border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</x-layout>
