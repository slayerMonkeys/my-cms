<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    /**
     * Show the page with all tags.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(): Application|Factory|View
    {
        $this->authorize("viewAny", Tag::class);
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the page for create a tag.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize("create", Tag::class);
        return view('admin.tags.create');
    }

    /**
     * Store a new tag in database.
     *
     * @param StoreTagRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());

        return redirect()
            ->route('admin.tags.index')
            ->with([
                "success" => "Tag Created !"
            ]);
    }

    /**
     * Show the page for edit a tag.
     *
     * @param Tag $tag
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Tag $tag)
    {
        $this->authorize("update", $tag);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update a tag.
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());

        return redirect()
            ->route('admin.tags.index')
            ->with([
                "success" => "Tag Updated !"
            ]);
    }

    /**
     * Delete a tag.
     *
     * @param Tag $tag
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize("delete", $tag);
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with([
                "success" => "Tag Deleted !"
            ]);
    }
}
