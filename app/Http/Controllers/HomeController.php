<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::user()->role == 'Admin'){
            $post = Post::orderBy('id', 'DESC')->get();
            $title = Post::orderBy('id', 'DESC')
                ->pluck('title')
                ->unique()
                ->values();
            $category = Category::orderBy('id', 'DESC')->get();
            $title_name = $request->title_name;
            return view('Post.post_list', compact('post', 'category','title_name','title'));
        }
        if(Auth::user()->role == 'User'){
            return redirect()->to('/');
        }
       
    }
}
