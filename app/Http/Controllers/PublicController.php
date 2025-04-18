<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function blog_details(Request $request)
    {
        $blog_details = Post::where('slug', $request->slug)->first();
        return view('Post_details', compact('blog_details'));
    }

    public function blog(Request $request)
    {
        $all_posts = Post::latest()->paginate(10);
        return view('public_post_list', compact('all_posts'));
    }
}
