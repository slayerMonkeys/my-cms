<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    /**
     * Show the home page.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $posts = Post::latest()->paginate($request->input('perPage', 10));

        return view('home', [
            'posts' => $posts
        ]);
    }
}
