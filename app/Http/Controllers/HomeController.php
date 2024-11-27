<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
   public function __invoke(Request $request)
   {

        $featuredPosts = Cache::remember('featuredPosts', Carbon::now()->addMonth(), function () {
            return Post::published()->featured()->latest('published_at')->take(3)->get();
        });

        $latestPosts = Cache::remember('latestPosts', Carbon::now()->addDay(), function () {
            return Post::published()->latest('published_at')->take(9)->get();
        });


        return view('home',[
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts
        ]);
   }
}
