<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view(
            'posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->simplePaginate(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function authorIndex(User $author)
    {
            return view('posts.index', [
                'posts' => $author->posts,
            ]);
    }
}
