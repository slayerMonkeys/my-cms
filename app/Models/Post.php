<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    protected $fillable = [
        'title',
        'post_image',
        'body'
    ];

    public function getPostImageAttribute($value): string
    {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }

        return asset('storage/' . $value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
