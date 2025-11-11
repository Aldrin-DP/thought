<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function home(){

        $query = Post::query()->with(['user', 'category']);

        if (filled(request('search'))) {
            $query->where('title', 'LIKE', '%' . request('search') . '%')
                  ->orWhere('body', 'LIKE', '%' . request('search') . '%');
        }
        if (filled(request('sort'))) {
            match (request('sort')){
                'likes' => $query->withCount('likes')->orderBy('likes_count', 'desc'),
                'comments' => $query->withCount('comments')->orderBy('comments_count', 'desc')
            };
        }
        if (filled(request('category'))){
            $query->where('category_id', request('category'));
        }

        $posts = $query->latest()->paginate(5);
        $categories = Category::all();

        return view('index', compact('posts', 'categories'));
    }

    public function mine() {

        $user = Auth::user();
        $query = $user->posts()->with('user')->withCount(['likes', 'comments']);

        if (filled(request('search'))){
            $query->where(function ($q){
                $q->where('title', 'LIKE', '%' . request('search') . '%')
                  ->orWhere('body', 'LIKE', '%' . request('search') . '%');
            });
        }
        if (filled(request('sort'))){
            match(request('sort')){
                'likes' => $query->withCount('likes')->orderBy('likes_count', 'DESC'),
                'comments' => $query->withCount('comments')->orderBy('comments_count', 'DESC')
            };
        }
        if (filled(request('category'))){
            $query->where('category_id', request('category'));
        }
        $myPosts = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('posts.my_post', ['posts' => $myPosts, 'categories' => $categories]);
    }

    public function create(){

        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function show(Post $post){

        $comments = $post->comments()->with('user.profile')->latest()->paginate(10);


        return view('posts.show', compact('post', 'comments'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|min:2',
            'body' => 'required|min:5',
            'category_id' => 'required'
        ]);
        $validated['user_id'] = Auth::id();
        Post::create($validated);

        return redirect()->route('index');
    }

    public function edit(Post $post){

        Gate::authorize('manage-post', $post);

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function destroy(Post $post){

        Gate::authorize('manage-post', $post);
        $post->delete();

        return redirect()->route('index');
    }

    public function update(Request $request, Post $post){

        $validated = $request->validate([
            'title' => 'required|min:2',
            'body' => 'required|min:5',
            'category_id'=> 'required'
        ]);
        $validated['user_id'] = Auth::id();
        $post->update($validated);

        return redirect()->route('index');
    }
}
