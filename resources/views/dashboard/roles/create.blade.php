<x-layout title="Create New Role">

    <div class="max-w-2xl mx-auto px-gutter py-12 mt-16" dir="ltr">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-8 shadow-sm">

            <div class="mb-6 border-b border-outline-variant pb-4 text-left">
                <h2 class="font-headline-md text-headline-md text-on-surface">Create New Role</h2>
                <p class="font-metadata text-metadata text-secondary mt-1">Define a new role and assign its specific system abilities.</p>
            </div>

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="mb-6 text-left">
                    <label class="block text-on-surface font-semibold font-ui-label text-ui-label mb-2">Role Name</label>
                    <input type="text" name="name"
                           class="w-full border border-outline-variant rounded bg-surface px-4 py-2.5 text-on-surface text-ui-label font-ui-label focus:outline-none focus:ring-2 focus:ring-primary-container focus:border-primary"
                           placeholder="e.g., Content Manager">
                </div>

                <div class="mb-6 text-left">
                    <label class="block text-on-surface font-semibold font-ui-label text-ui-label mb-3">Select Abilities (Permissions)</label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($abilities as $key => $label)
                            <div class="flex items-center p-3 border border-outline-variant rounded-lg bg-surface hover:bg-surface-container-low transition-colors duration-150">
                                <input type="checkbox" name="abilities[]" value="{{ $key }}" id="ab_{{ $key }}"
                                       class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary-container bg-surface-container-lowest">
                                <label for="ab_{{ $key }}" class="ml-3 text-on-surface-variant font-ui-label text-ui-label cursor-pointer select-none">
                                    {{ $label }}
                                    <span class="block text-[11px] text-secondary font-mono mt-0.5">{{ $key }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center border-t border-outline-variant pt-6 mt-8">
                    <a href="{{ route('roles.index') }}"
                       class="text-secondary hover:text-on-surface font-ui-button text-ui-label font-medium transition-colors duration-150 py-2">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary px-8 py-2.5 rounded-full font-ui-button text-ui-label font-bold shadow-sm transition-all duration-150">
                        Save Role
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layout>
