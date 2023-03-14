<?php

namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'min:3', Rule::unique(Tag::class, "name")->ignore($this->route('tag'))],
            'slug' => ['string', 'required', 'min:3', Rule::unique(Tag::class, "name")->ignore($this->route('tag'))]
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('tag'));
    }
}
