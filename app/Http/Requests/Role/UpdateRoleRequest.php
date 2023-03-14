<?php

namespace App\Http\Requests\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('role'));
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();
        $formattedData = [];
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
            "name" => ['required', 'alpha_dash', Rule::unique(Role::class, "name")->ignore($this->route('role'))],
            "permissions" => ['array', Rule::exists(Permission::class, "id")]
        ];
    }
}
