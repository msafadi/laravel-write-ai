<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Gate::denies('users.view')) {
        //     abort(403);
        // }
        // $user = Auth::user();
        // abort_if(!$user->can('view-any', User::class), 403);

        $users = User::with('roles')->paginate(10);

        return view('dashboard.users.index', compact('users'));

        //echo 'Admin Dashboard';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Auth::user()->can('create', User::class), 403);
        return __METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //abort_if(!Auth::user()->can('create', User::class), 403);
        return __METHOD__;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //abort_if(!Auth::user()->can('view', $user), 403);
        return __METHOD__;
    }


    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //abort_if(!Auth::user()->can('update', $user), 403);

        $roles = Role::all();

        $userRoles = $user->roles->pluck('id')->toArray();

        return view('dashboard.users.edit', compact('user', 'roles', 'userRoles'));
      //  return __METHOD__;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //abort_if(!Auth::user()->can('update', $user), 403);
     //   return __METHOD__;
        $request->validate([
            'roles'   => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('users.index')
            ->with('success', 'User roles updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(User $user)
//    {
//        Gate::authorize('delete', $user);
//        //abort_if(!Auth::user()->can('delete', $user), 403);
//        return __METHOD__;
//    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
