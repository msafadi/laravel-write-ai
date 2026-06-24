<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    const ABILITIES = [
        'posts.view'   => 'View Posts',
        'posts.create' => 'Create Posts',
        'posts.update' => 'Update Posts',
        'posts.delete' => 'Delete Posts',
        'roles.view'   => 'View Roles',
        'roles.manage' => 'Manage Roles',
    ];

    public function index()
    {
        $roles = Role::paginate(10);
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        $abilities = self::ABILITIES;
        return view('dashboard.roles.create', compact('abilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:roles,name',
            'abilities'   => 'required|array',
            'abilities.*' => 'string' // التأكد أن كل عنصر داخل المصفوفة هو نص
        ]);

        Role::create([
            'name'      => $request->name,
            'abilities' => $request->abilities,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        $abilities = self::ABILITIES;

        $roleAbilities = $role->abilities ?? [];

        return view('dashboard.roles.edit', compact('role', 'abilities', 'roleAbilities'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:roles,name,' . $role->id,
            'abilities'   => 'required|array',
            'abilities.*' => 'string'
        ]);

        $role->update([
            'name'      => $request->name,
            'abilities' => $request->abilities,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully!');
    }

    /**
     * حذف دور معين من النظام
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully!');
    }
}
