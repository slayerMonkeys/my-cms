<?php

namespace App\Http\Controllers;

use App\Enums\Permissions\PostPermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\UserPermissions;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Show the page with all roles
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(): Application|Factory|View
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the page for create a role.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(): Application|Factory|View
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a new role in database.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->except('permissions'));
        $role->permissions()->attach($request->permissions);

        return redirect()
            ->route('admin.roles.index')
            ->with([
                'success' => 'Role Created !'
            ]);
    }

    /**
     * Show the page for edit a role.
     *
     * @param Role $role
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Role $role): Application|Factory|View
    {
        $this->authorize('update', $role);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update a role.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->except('permissions'));

        $role->permissions()->sync($request->permissions);

        return response()
            ->redirectTo(route('admin.roles.index'))
            ->with([
                'success' => "Role Updated !"
            ]);
    }

    /**
     * Delete a role.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return response()
            ->redirectTo(route('admin.roles.index'))
            ->with([
                'success' => "Role Deleted !"
            ]);
    }
}
