<x-layout title="Edit User Roles">

    <div class="max-w-xl mx-auto px-gutter py-12 mt-16" dir="ltr">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-8 shadow-sm">

            <div class="mb-6 border-b border-outline-variant pb-4 text-left">
                <h2 class="font-headline-md text-headline-md text-on-surface">Edit User Roles</h2>
                <p class="font-metadata text-metadata text-secondary mt-1">
                    Updating privileges for: <span class="font-bold text-primary font-ui-label">{{ $user->name }}</span> ({{ $user->email }})
                </p>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6 text-left">
                    <label class="block text-on-surface font-semibold font-ui-label text-ui-label mb-3">
                        Select appropriate roles for this user:
                    </label>

                    <div class="space-y-3">
                        @foreach($roles as $role)
                            <div class="flex items-start p-4 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors duration-150">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                           id="role_{{ $role->id }}"
                                           @checked(in_array($role->id, $userRoles))
                                           class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary-container bg-surface">
                                </div>
                                <label for="role_{{ $role->id }}" class="ml-3 text-on-surface cursor-pointer select-none">
                                    <span class="block font-medium font-ui-label text-ui-label text-on-surface">{{ $role->name }}</span>
                                    <span class="block font-metadata text-metadata text-secondary mt-0.5">
                                        ({{ count($role->abilities) }} {{ count($role->abilities) === 1 ? 'ability' : 'abilities' }} assigned)
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center border-t border-outline-variant pt-6 mt-8">
                    <a href="{{ route('users.index') }}"
                       class="text-secondary hover:text-on-surface font-ui-button text-ui-label font-medium transition-colors duration-150 py-2">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary px-8 py-2.5 rounded-full font-ui-button text-ui-label font-bold shadow-sm transition-all duration-150">
                        Update Roles
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layout>
