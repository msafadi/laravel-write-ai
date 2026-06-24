<x-layout title="Role Management">

    <div class="max-w-container-max mx-auto px-gutter py-12 mt-16" dir="ltr">
        <div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
            <div class="text-left">
                <h2 class="font-headline-md text-headline-md text-on-surface">Manage Roles</h2>
                <p class="font-metadata text-metadata text-secondary mt-1">Configure user access levels and system permissions.</p>
            </div>
            <a href="{{ route('roles.create') }}"
               class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary px-5 py-2.5 rounded-full font-ui-button text-ui-label font-bold shadow-sm transition-all duration-150 inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-sm" style="font-size: 18px;">add</span>
                Add New Role
            </a>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg overflow-hidden shadow-sm">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-surface-container border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">Role Name</th>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">Abilities / Permissions</th>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                @foreach($roles as $role)
                    <tr class="hover:bg-surface-container-low transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="font-medium text-on-surface font-ui-label">{{ $role->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if(is_array($role->abilities) || is_object($role->abilities))
                                @foreach($role->abilities as $ability)
                                    <span class="inline-block bg-tertiary-fixed text-on-tertiary-fixed text-xs font-semibold px-2.5 py-1 rounded font-mono mr-1.5 mb-1 shadow-sm border border-outline-variant">
                                        {{ $ability }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-secondary text-xs italic font-metadata">No abilities defined</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex items-center gap-4">
                            <a href="{{ route('roles.edit', $role->id) }}"
                               class="text-primary hover:text-on-primary-fixed-variant font-ui-button text-ui-label font-bold transition-colors duration-150 inline-flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-sm" style="font-size: 16px;">edit</span>
                                Edit
                            </a>

                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this role?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-error hover:text-on-error-container font-ui-button text-ui-label font-bold transition-colors duration-150 inline-flex items-center gap-0.5 bg-transparent border-none p-0 cursor-pointer">
                                    <span class="material-symbols-outlined text-sm" style="font-size: 16px;">delete</span>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $roles->links() }}
        </div>
    </div>

</x-layout>
