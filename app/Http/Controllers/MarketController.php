<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\UserPostOrder;

class MarketController extends Controller
{
    public function index(Request $request)
    {
    	$posts = Post::where('sellable', 1)->paginate(5);

        if ($request->ajax()) {

            return view('lazyLoadedMarketPlace')->with('posts', $posts);

        }

        return view('marketPlace');

    	//return view('marketPlace')->with('posts', $posts);
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
