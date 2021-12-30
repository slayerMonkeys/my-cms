<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request): RedirectResponse
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

        return redirect()
            ->route('post.index')
            ->with([
            'success' => 'Post was created'
        ]);

    }

    public function delete(Post $post)
    {
        return view("posts.delete", compact('post'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        Session::flash('success', 'Post was deleted');

        return back();
    }
}
