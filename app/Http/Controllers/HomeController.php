<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //$users = User::all();
        // $posts = Post::whereNotNull('title')->whereNotNull('slug')->whereNull('archived')->get()->reverse();

        // return view('home')
        //     //->with('users', $users)
        //     ->with('posts', $posts);

        $posts = Post::whereNotNull('title')->whereNotNull('slug')->whereNull('archived')->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {

            return view('lazyLoadedPosts')->with('posts', $posts);

        }


        return view('home');
    }

    public function createPost()
    {
        return view('createPost');
    }
}
