<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:8', 'max:255', Rule::unique(Post::class, "title")->ignore($this->route('post'))],
            'post_image' => ['mimes:jpeg,png,jpg,bmp'],
            'body' => ['required', 'min:150'],
            'tags' => ['array', Rule::exists(Tag::class, "id")]
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('post'));
    }
}
