<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'mimes:jpeg,png,jpg,bmp',
            'body' => 'required|min:150'
        ]);

        if ($request->file('post_image')->isValid()) {
            $payload['post_image'] = $request->post_image->store('images');
        }

        Auth::user()->posts()->create($payload);

        return back();

    }
}
