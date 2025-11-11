<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function usersIndex() {

        $query = User::query()->with('profile');

        if (filled(request('search'))){
            $query->where('firstname', 'LIKE', '%' . request('search') . '%')
                  ->orWhere('lastname', 'LIKE', '%' . request('search') . '%');
        }

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function usersDestroy(User $user) {

        $user->delete();

        return redirect()->back();
    }

    public function postsIndex(){

        $query = Post::with(['user', 'likes', 'comments']);

        if (filled(request('search'))){
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        $posts = $query->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function postsDestroy(Post $post){

        $post->delete();

        return redirect()->back();
    }

    public function categoriesIndex(){

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function categoriesStore(Request $request){
        $validated = $request->validate([
            'category' => 'required|string|max:255'
        ]);
        Category::create($validated);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function categoriesDestroy(Category $category){

        $category->delete();

        return redirect()->back()->with('deleteMessage', 'Category deleted successfully');
    }
}
