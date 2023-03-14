<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use App\Models\User;
use App\Traits\SwitchsValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $data = $this->all();
        $formattedData = [];
        $formattedData["roles"] = [];
        foreach (array_keys($data) as $param) {
            if (str_starts_with($param, 'role_')) {
                $formattedData["roles"][] = $data[$param];
            } else {
                $formattedData[$param] = $data[$param];
            }
        }
        $this->replace($formattedData);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($this->route('user'))],
            'roles' => ['array', Rule::exists(Role::class, 'id')]
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('user'));
    }
}
