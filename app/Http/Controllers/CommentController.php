<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post){
        $validated = $request->validate([
            'comment' => 'required|max:250'
        ]);
        $user = Auth::user();

        if (!$user){
            return redirect()->route('login')->with('commentError', 'You must be logged in to comment in a post.');
        }

        $validated['user_id'] = $user->id;
        $validated['post_id'] = $post->id;
        $validated['parent_id'] = $request->input('parent_id');

        Comment::create($validated);

        return redirect()->back();
    }

    public function destroy(Comment $comment){

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function edit(Comment $comment){

        $comments = Comment::latest()->get();
        $post = Post::where('id', $comment->post_id);
        return view('comments.edit', compact('post', 'comments'));
    }
}
