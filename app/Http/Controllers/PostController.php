<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.postIndex',[
            // 'posts' => Post::all(),
            // 'latestPosts' => Post::published()->latest('published_at')->take(9)->get(),
            'categories' => Category::
            whereHas('posts', function($query){
                $query->published();
            })->
            take(10)->get()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.postView',
        [
            'post' => $post,
        ]);
    }
}
