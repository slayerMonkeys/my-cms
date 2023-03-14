<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * Show admin home page.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.index", [
            "postsCount" => Post::count(),
            "authorCount" => User::has('posts')->count(),
            "postTagCount" => Tag::withCount("posts")->pluck("posts_count", "name")->sortDesc()->slice(0, 10)->toArray()
        ]);
    }
}
