<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:8', 'max:255', Rule::unique(Post::class, "title")],
            'post_image' => ['mimes:jpeg,png,jpg,bmp'],
            'body' => ['required', 'min:150'],
            'tags' => ['array', Rule::exists(Tag::class, "id")]
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('create', Post::class);
    }
}
