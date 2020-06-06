<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\UserPostOrder;

class MarketController extends Controller
{
    public function index()
    {
    	$posts = Post::where('sellable', 1)->get();
    	return view('marketPlace')->with('posts', $posts);
    }

    public static function owned($userId, $postId): bool
    {
    	$owned = UserPostOrder::where('user_id', $userId)->where('post_id', $postId)->count();

    	if ($owned > 0) {
    		return true;
    	}

    	return false;
    }
}
