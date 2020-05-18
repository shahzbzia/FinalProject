<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class MarketController extends Controller
{
    public function index()
    {
    	$posts = Post::where('sellable', 1)->get();
    	return view('marketPlace')->with('posts', $posts);
    }
}
