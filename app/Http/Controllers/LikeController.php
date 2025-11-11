<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggleLike(Post $post){

        $user = Auth::user();

        if (!$user){
            return redirect()->route('login')->with('error', 'You must be logged in to like a post.');
        }

        $existingLike = $post->likes()->where('user_id', $user->id)->first();

        if ($existingLike){
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);
        }

        return redirect()->back();
    }
}
