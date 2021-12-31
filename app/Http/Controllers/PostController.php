<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $payload = $request->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'mimes:jpeg,png,jpg,bmp',
            'body' => 'required|min:150'
        ]);

        if ($request->file('post_image')->isValid()) {
            $payload['post_image'] = $request->post_image->store('images');
            $post->post_image = $payload['post_image'];
        }

        $post->title = $payload['title'];
        $post->body = $payload['body'];

        $post->save();

        return Redirect::route("post.index")
            ->with([
                'success' => 'Post was successfully updated'
            ]);
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        return view("posts.delete", compact('post'));
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        Session::flash('success', 'Post was deleted');

        return back();
    }
}
