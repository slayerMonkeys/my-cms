<?php

namespace App\Http\Controllers;

use App\Enums\DefaultRoles;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the page with all users.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(): Application|Factory|View
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();

        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the profile of a user.
     *
     * @param User $user
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function showProfile(User $user): Application|Factory|View
    {
        $this->authorize('view', $user);
        $latestUserPosts = $user->posts()->select(["title", "id"])->latest()->limit(5)->get();
        $userRoles = $user->roles()->select("name")->get();

        return view('admin.users.profile', compact("user", "latestUserPosts", "userRoles"));
    }

    /**
     * Show the page for create a user.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(): Application|Factory|View
    {
        $this->authorize('create', User::class);
        $roles = Role::query()->where("slug", "!=", "user")->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user in database.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {

        $user = User::create($request->except(['roles']));

        $roleUser = Role::where('slug', DefaultRoles::USER)->first();
        if (!in_array($roleUser->id, $request->roles, true)) {
            $request->roles = [$roleUser->id, ...$request->roles];
        }
        $user->roles()->attach($request->roles);

        return redirect()
            ->route('admin.users.index')
            ->with([
                'success' => 'User Created !'
            ]);
    }

    /**
     * Show the page for edit a user.
     *
     * @param User $user
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::query()->where("slug", "!=", "user")->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update a user.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->except('roles'));

        $roleUser = Role::where('slug', DefaultRoles::USER)->first();
        if (!in_array($roleUser->id, $request->roles, true)) {
            $request->get('roles')[] = $roleUser->id;
        }
        $user->roles()->sync($request->roles);

        return redirect()
            ->route('admin.users.index')
            ->with([
                'success' => 'User Updated !'
            ]);
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()
            ->redirectTo(route('admin.users.index'))
            ->with([
                'success' => "User Deleted !"
            ]);
    }

}
