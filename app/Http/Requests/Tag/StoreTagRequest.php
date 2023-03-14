<?php

namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreTagRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->replace([
            ...$this->all(),
            'slug' => Str::slug($this->name)
        ]);
    }

    public function rules(): array
    {
        return [
            "name" => ['string', 'required', 'min:3', Rule::unique(Tag::class, "name")],
            'slug' => ['string', 'required', 'min:3', Rule::unique(Tag::class, "name")]
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can("create", Tag::class);
    }
}
