<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{

    /**
     * Show the page with all posts.
     *
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::all();
        return view("admin.posts.index", compact('posts'));
    }

    /**
     * Show the page with a post.
     *
     * @param Post $post
     * @return Factory|View|Application
     */
    public function show(Post $post): Factory|View|Application
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the page for create a post.
     *
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize("create", Post::class);

        return view("admin.posts.create", [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a new post in database.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        if ($request->file('post_image')?->isValid()) {
            $payload['post_image'] = $request->post_image->store('images');
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $user = Auth::user();
        $user?->posts()->save($post);
        $post->tags()->attach($request->tags);


        return redirect()
            ->route('admin.posts.index')
            ->with([
                'success' => 'Post Created !'
            ]);

    }

    /**
     * Show the page for edit a post.
     *
     * @param Post $post
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Post $post): View|Factory|Application
    {
        $this->authorize("update", $post);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update a post.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $payload = $request->validated();

        if ($request->file('post_image')?->isValid()) {
            $payload['post_image'] = $request->post_image->store('images');
            $post->post_image = $payload['post_image'];
        }

        $post->title = $payload['title'];
        $post->body = $payload['body'];

        $post->save();

        $post->tags()->sync($request->tags);

        return redirect()
            ->route("admin.posts.index")
            ->with([
                'success' => 'Post Updated !'
            ]);
    }

    /**
     * Delete a post.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize("delete", $post);
        $post->delete();

        return redirect()
            ->route("admin.posts.index")
            ->with([
                'success' => 'Post Deleted !'
            ]);
    }
}
