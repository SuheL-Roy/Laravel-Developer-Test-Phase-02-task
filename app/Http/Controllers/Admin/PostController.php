<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    protected $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->middleware('auth');
        $this->posts = $posts;
    }
    public function create_post(Request $request)
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('Post.create_post', compact('category'));
    }
    public function store(StorePostRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }
        $this->posts->store($data);


        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $this->posts->delete($request->id);
        return back()->with('danger', 'Successfully Deleted');
    }

    public function get_post(Request $request)
    {
        $post = Post::where('id', $request->id)->get();
        return response()->json($post);
    }
    public function update(UpdatePostRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }
        $this->posts->update($request->id, $data);

        return back()->with('success', 'Successfully updated');
    }
    public function search_title(Request $request)
    {
        $post = $this->posts->all($request->title_name);
        $title = Post::orderBy('id', 'DESC')
            ->pluck('title')
            ->unique()
            ->values();
        $title_name = $request->title_name;
        $category = Category::orderBy('id', 'DESC')->get();
        return view('Post.post_list', compact('post', 'title', 'category', 'title_name'));
    }
}
