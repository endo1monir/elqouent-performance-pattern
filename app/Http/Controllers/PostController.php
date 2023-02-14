<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index()
    {
        $posts = (object)[];

//    $posts->requested=Post::where('status',0)->count();
//    $posts->planned=Post::where('status',1)->count();
//    $posts->completed=Post::where('status',2)->count();
        $posts = Post::toBase()->
        selectRaw("count(case when status=0 then 1 end) as requested")
        ->selectRaw("count(case when status=1 then 1 end) as planned")
        ->selectRaw("count(case when status=2 then 1 end) as completed")
        ->first();
        return view('posts', get_defined_vars());
    }
}
