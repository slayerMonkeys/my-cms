<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Hash password attribute.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Defined if the user has the role.
     *
     * @param string $role_slug
     * @return bool
     */
    public function hasRole(string $role_slug): bool
    {
        foreach ($this->roles as $role) {
            if ($role_slug === $role->slug) {
                return true;
            }
        }

        return false;
    }

    /**
     * Defined if the user has the permission.
     *
     * @param string $permission_slug
     * @return bool
     */
    public function hasPermission(string $permission_slug): bool
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission_slug === $permission->slug) {
                    return true;
                }
            }
        }

        foreach ($this->permissions as $permission) {
            if ($permission_slug === $permission->slug) {
                return true;
            }
        }

        return false;
    }
}
