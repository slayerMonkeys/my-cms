<?php

namespace App\Http\Requests\Role;

use App\Enums\Permissions\PostPermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\UserPermissions;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\SwitchsValidationTrait;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->can('create', Role::class);
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();
        $formattedData = [
            'slug' => Str::slug($data['name'])
        ];
        $formattedData["permissions"] = [];
        foreach (array_keys($data) as $param) {
            if (str_starts_with($param, 'permission_')) {
                $formattedData["permissions"][] = $data[$param];
            } else {
                $formattedData[$param] = $data[$param];
            }
        }
        $this->replace($formattedData);
    }

    public function rules(): array
    {
        return [
            "name" => ['required', 'string', Rule::unique(Role::class, "name")],
            "slug" => ['required', 'alpha_dash', Rule::unique(Role::class, "name")],
            "permissions" => ['array', Rule::exists(Permission::class, "id")]
        ];
    }
}
