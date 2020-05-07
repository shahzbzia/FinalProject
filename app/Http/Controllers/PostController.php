<?php

namespace App\Http\Controllers;

use App\Post;
use App\Vote;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Image\CreateImagePostRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('home')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function imagePost(CreateImagePostRequest $request)
    {
        $user = Auth::user();

        $post = Post::create([

            'title' => $request->title,
            'slug' => $request->slug,
            'status' => 'published',
            'type' => 'image', 
            'description'  => $request->description, 
            'user_id' => $user->id,

        ]);

        if (request()->has('sellable')) {

            $uuid = Str::uuid()->toString();
            
            $post->update([
                'sellable' => 1,
                'royaltyFee' => $request->royaltyFee,
                'price' => $request->price,
                'download_id' => $uuid,
            ]);

            if (request()->hasFile('dContent')) {
                $post->addMediaFromRequest('dContent')->toMediaCollection('downloads');
            }   
        }

        if (request()->hasFile('mainImage')) {
            $post->addMediaFromRequest('mainImage')->toMediaCollection('posts');
        }

        return 'The post was created successfully';
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function downloadable($download_id)
    {
        $post = Post::where('download_id', $download_id)->firstOrFail();

        return $post->getMedia('downloads')->first();
    }

    public function upVotePost(Request $request)
    {
        $user = Auth::user();
        $postId = $request->postId;
        $post = Post::whereId($postId)->first();
        $post->checkAndCreatePostUpVoteForUser($user->id);

        return response()->json(['votesCount' => $post->getTotalVoteCount()]);

    }

    public function downVotePost(Request $request)
    {
        $user = Auth::user();
        $postId = $request->postId;
        $post = Post::whereId($postId)->first();
        $post->checkAndCreatePostDownVoteForUser($user->id);

        return response()->json(['votesCount' => $post->getTotalVoteCount()]);
    }
}
