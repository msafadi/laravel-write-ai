<x-layout title="User & Role Management">

    <div class="max-w-container-max mx-auto px-gutter py-12 mt-16">
        <div class="mb-8 border-b border-outline-variant pb-4">
            <h2 class="font-headline-md text-headline-md text-on-surface">Manage Users & Roles</h2>
            <p class="font-metadata text-metadata text-secondary mt-1">Assign and modify roles for platform users.</p>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-lg overflow-hidden shadow-sm">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-surface-container border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">Current Roles</th>
                    <th class="px-6 py-4 font-ui-label text-ui-label text-on-surface-variant font-semibold uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                @foreach($users as $user)
                    <tr class="hover:bg-surface-container-low transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="font-medium text-on-surface font-ui-label">{{ $user->name }}</div>
                            <div class="text-xs text-secondary font-metadata mt-0.5">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @forelse($user->roles as $role)
                                <span class="inline-block bg-primary-fixed text-on-primary-fixed text-xs font-semibold px-2.5 py-1 rounded font-ui-label mr-1.5 mb-1 shadow-sm">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-secondary text-xs italic font-metadata">No roles assigned</span>
                            @endforelse
                        </td>

                        <td class="px-6 py-4 flex items-center gap-4">
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="text-primary hover:text-on-primary-fixed-variant font-ui-button text-ui-label font-bold transition-colors duration-150 inline-flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-sm" style="font-size: 16px;">edit</span>
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
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
    </div>

</x-layout>
