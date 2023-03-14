<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Defined if the role has the permission.
     *
     * @param string $permission_slug
     * @return bool
     */
    public function hasPermission(string $permission_slug): bool
    {
        foreach ($this->permissions as $permission) {
            if ($permission_slug === $permission->slug) {
                return true;
            }
        }

        return false;
    }
}
