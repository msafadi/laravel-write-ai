<x-layout title="Category Details">

    <main class="pt-24 pb-section-gap max-w-container-max mx-auto px-gutter">

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-8 mb-10">

            <h1 class="text-3xl font-bold text-on-surface mb-2">
                {{ $category->name }}
            </h1>

            <p class="text-on-surface-variant">
                {{ $category->description ?? 'No description' }}
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">


            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 hover:border-primary transition-all">

                <p class="text-sm text-on-surface-variant uppercase mb-2">Posts</p>
                <p class="text-3xl font-bold text-on-surface">
                    10
                </p>

            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 hover:border-primary transition-all">

                <p class="text-sm text-on-surface-variant uppercase mb-2">Views</p>
                <p class="text-3xl font-bold text-on-surface">
                    0
                </p>

            </div>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
               class="px-5 py-3 bg-primary text-on-primary rounded-lg hover:opacity-90 transition-all flex items-center gap-2">

                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit Category

            </a>

            <a href="{{ route('dashboard.categories.index') }}"
               class="px-5 py-3 bg-surface-container-low border border-outline-variant rounded-lg hover:bg-surface transition-all">

                Back

            </a>

        </div>

    </main>

</x-layout>
