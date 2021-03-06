<?php

namespace App\Http\Controllers;

use App\Post;
use App\Vote;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Image\CreateImagePostRequest;
use App\Http\Requests\Post\Video\CreateVideoPostRequest;
//use App\Http\Requests\Post\Video\UploadVideoRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Auth;
use Illuminate\Support\Str;
use Validator;
use Session;
use DB;
use Comment;
use App\Http\Requests\Post\EditPostRequest;
use Spatie\MediaLibrary\MediaStream;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostDeleted;


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
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('postDetails')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        return view('editPost')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        if ($post->type == 'video') {

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'royaltyFee' => $request->royaltyFee,
                'dVidContent' => $request->url,
                'sellable' => null,
            ]);

        } else {

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'royaltyFee' => $request->royaltyFee,
                'sellable' => null,
            ]);     
        }

        if (request()->has('sellable')) {

            $uuid = Str::uuid()->toString();
            
            $post->update([
                'sellable' => 1,
                'royaltyFee' => $request->royaltyFee,
                'download_id' => $uuid,
            ]);

            if (request()->hasFile('dContent')) {
                $post->addMediaFromRequest('dContent')->toMediaCollection('downloads');
            }

            if (request()->has('dContentVid')) {
                $post->update([
                    'url' => $request->dContentVid,
                ]);
            }
        }

        session()->flash('success', 'Post added/updated successfully');

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->firstOrFail();

        if (!$post->checkIfSold()) {
            $post->delete();        
        }else{
            $post->update([
                'archived' => 1,
            ]);
        }

        session()->flash('success', 'Post deleted successfully!');

        return redirect(route('home'));

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
                'download_id' => $uuid,
            ]);

            if (request()->hasFile('dContent')) {
                $post->addMediaFromRequest('dContent')->toMediaCollection('downloads');
            }   
        }

        if (request()->hasFile('mainImage')) {
            $post->addMediaFromRequest('mainImage')->toMediaCollection('images');
        }

        session()->flash('success', 'Image posted successfully');

        return redirect(route('home'));
    }

    public function uploadVideo(Request $request)
    {
        $rules = array(
            'mainVideo' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:256000',);

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user = Auth::user();

        $post = Post::create([

            'user_id' => $user->id,
            'type' => 'video',

        ]);

        if (request()->hasFile('mainVideo')) {
            $post->addMediaFromRequest('mainVideo')->toMediaCollection('video');
            //$post->addMediaFromUrl(config('app.url') . '/images/placeholder.png')->toMediaCollection('downloads');
        }

        $output = array(
            'success' => 'Video uploaded successfully',
            'postId' => $post->id,
            'video' => '<div class="flex flex-col lg:flex-row">
                            <video width="400" height="240" controls>
                                <source src="'.asset($post->getMedia('video')->first()->getUrl()).'" type="'.$post->mime_type.'">
                            </video>

                            <button type="button" id="del-video" class="align-middle mx-auto my-auto text-red-700 flex">
                                <svg class="text-red-700 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"><path class="text-red-700" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z"/></svg>
                                <p>Delete / Change File</p>
                            </button>

                            <script>
                                $(document).ready(function(){

                                    $("#del-video").click(function() {
                                        $("#success").empty();
                                        $("#uploadVid").toggleClass("hidden");
                                        $(".progress-bar").text("0%");
                                        $(".progress-bar").css("width", "0%");
                                        $("#formVidInfo").hide();
                                        $("#formVidInfo :input").attr("disabled", true);
                                        var _token = "'. Session::token() . '";
                                        $.ajax(
                                        {
                                            url: "'.route('deleteUploadedVideo', $post->id).'",
                                            type: "DELETE",
                                            dataType: "JSON",
                                            data: {
                                                "_method": "DELETE",
                                                "_token": _token,
                                            },
                                            success: function ()
                                            {
                                                console.log("Post Deleted SuccessFully");
                                            }
                                        });

                                    });
                                    
                                });
                            </script>
                        </div>',
        );

        return response()->json($output);
    }

    public function deleteUploadedVideo($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $post->clearMediaCollection();
        DB::table('media')->delete($id);
        $post->forceDelete();
        return response()->json();
    }

    public function videoPost(Request $request)
    {

        $id = $request->id;

        $post = Post::whereId($id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'titleVid' => 'required|string', 
            'descriptionVid'  => 'nullable|string', 
            'sellable' => 'nullable|string',
            'royaltyFeeVid' => 'nullable|numeric',
            'dContentVid' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect(route('editPost', $post->id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $post->update([

            'title' => $request->titleVid,
            'slug' => $request->slugVid,
            'status' => 'published',
            'description'  => $request->descriptionVid,

        ]);

        if (request()->has('sellable')) {

            $uuid = Str::uuid()->toString();
            
            $post->update([
                'sellable' => 1,
                'royaltyFee' => $request->royaltyFeeVid,
                'url' => $request->dContentVid,
                'download_id' => $uuid,
            ]);   
        }

        session()->flash('success', 'Video posted successfully');

        return redirect(route('home'));
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function downloadable($download_id)
    {
        $post = Post::where('download_id', $download_id)->firstOrFail();

        if ($post->type == 'image') {
            $downloads = $post->getMedia('downloads');
            return MediaStream::create($post->title . '.zip')->addMedia($downloads);
        }
        else{
            return redirect()->to($post->url);
        }
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

    public function allPosts(Request $request)
    {
        $posts = Post::paginate(10);

        return view('admin.allSearchPosts')->with('posts', $posts);
    }

    public function deleteByAdmin($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $postTitle = $post->title;
        $postMakerName = $post->user->firstName . ' ' . $post->user->lastName;
        $postMakerEmail = $post->user->email;

        Mail::to($postMakerEmail)->send(new PostDeleted($postMakerName, $postTitle));

        $post->delete();

        session()->flash('success', 'Post softDeleted successfully!.');

        return redirect()->route('all.posts');
    }

    public function postSearch(Request $request)
    {

        if($request->get('query')){

            $query = $request->get('query');

            $data = Post::search($query)->paginate(5);

            $output = '<ul>';

            foreach ($data as $row) {

                $output .= '';
                $output .= '<li> <a class="block px-4 py-2 text-gray-800 hover:bg-'. Auth::user()->theme->value.'-500 hover:no-underline hover:text-white text-sm" href="'.route('post.show', $row->slug).'"> <div class="flex justify-start"> <p>'. $row->title .' </p> </div> </a></li>';
            }

            $output .= '</ul>';

            $output .= '<a href="'.route('postSearchAllResults', $query).'" class="block px-4 py-2 text-blue-800 font-semibold hover:underline">See all results for "'.$query.'"</a>';
            //$requestQuery = $query;
            echo $output;

        }

    }

    public function postSearchAllResults($query)
    {

        $posts = Post::search($query)->get();

        return view('home')
            ->with('posts', $posts)
            ->with('query', $query);
    }

}
