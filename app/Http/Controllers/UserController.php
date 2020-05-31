<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Theme;
use App\Gender;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App;
use DB;
use App\Post;

class UserController extends Controller
{

    public $requestQuery = '';

	public function profile($userName)
    {
        $user = User::where("userName", $userName)->firstOrFail();
        return view('profile')->with('user', $user);
    }

    public function showUserEditForm()
    {

        $user = Auth::user();

        $themes = Theme::all();
        $genders = Gender::all();


        return view('auth.register')
            ->with('user', $user)
            ->with('themes', $themes)
            ->with('genders', $genders);

    }

    public function update(UpdateProfileRequest $request, $id)
    {
        
        $user = User::whereId($id)->firstOrFail();

        $hasImage = false;
        $hasCoverImage = false;

        if ($request->hasFile('image')) 
        {

            $image = $request->image->store('profile', 'public');

            Storage::disk('public')->delete($user->image);

            $data['image'] = $image;

            $hasImage = true;

        }

        if ($request->hasFile('coverImage')) 
        {

            $coverImage = $request->coverImage->store('profile', 'public');

            Storage::disk('public')->delete($user->coverImage);

            $data['coverImage'] = $coverImage;

            $hasCoverImage = true;

        }
        

        //update attributes
        $user->update([

            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'countryCode' => $request->countryCode,
            'number' => $request->number,
            'theme_id' => $request->theme_id,
            'address' => $request->address,
            'gender_id' => $request->gender_id,
            'birthDate' => $request->birthDate,
            'profession' => $request->profession,
            'aboutMe' => $request->aboutMe,
        ]);

        if ($hasImage) 
        {
            
            $user->update([
                'image' => $image,
            ]);
            
        }

        if ($hasCoverImage) 
        {
            
            $user->update([
                'coverImage' => $coverImage,
            ]);
            
        }

        session()->flash('success', 'Profile updated successfully.');

        return redirect(route('home'));
    }

    public function nameList(Request $request)
    {

        if($request->get('query')){

            $query = $request->get('query');
            $data = User::where('firstName', 'LIKE', "%{$query}%")
                    ->orWhere('lastName', 'LIKE', "%{$query}%")
                    ->orWhere('userName', 'LIKE', "%{$query}%")
                    ->orderBy('firstName', 'asc')
                    ->limit(5)
                    ->get();

            $output = '<ul>';

            foreach ($data as $row) {
                $userImage = ($row->image) ? asset("storage/".$row->image) : asset('/images/blank-profile.png');

                if(App::environment('production')) {
                  $userImage = ($row->image) ? asset("storage/app/public/".$row->image) : asset('/public/images/blank-profile.png');
                }

                $output .= '';
                $output .= '<li> <a class="block px-4 py-2 text-gray-800 hover:bg-'. Auth::user()->theme->value.'-500 hover:no-underline hover:text-white text-sm" href="'.route('user.profile', $row->userName).'"> <div class="flex justify-start"> <img src="'.$userImage.'" class="rounded-full mr-1 border border-black border-1" width="25" height="3">' . $row->firstName . ' ' . $row->lastName .' </div> </a></li>';
            }

            $output .= '</ul>';

            $output .= '<a href="'.route('nameListAllResults', $query).'" class="block px-4 py-2 text-blue-800 font-semibold hover:underline">See all results for "'.$query.'"</a>';
            //$requestQuery = $query;
            echo $output;

        }

    }

    public function nameListAllResults($query)
    {

        $users = User::where('firstName', 'LIKE', "%{$query}%")
                ->orWhere('lastName', 'LIKE', "%{$query}%")
                ->orWhere('userName', 'LIKE', "%{$query}%")
                ->orderBy('firstName', 'asc')
                ->get();

        return view('nameSearchResults')
            ->with('users', $users)
            ->with('query', $query);
    }

    public function toggleFollow(Request $request)
    {

        $user = User::find($request->user_id);
        $auth = Auth::user();
        $auth->toggleFollow($user);

        $response = DB::table('user_follower')->where('following_id', $request->user_id)->where('follower_id', $auth->id)->count();
        //dd($response);

        if ($response == 0) {
            $res = 'unfollowed';
        }else{
            $res = 'followed';
        }

        return response()->json(['response'=>$res]);

    }

    public function myPosts($userName)
    {
        $user = User::where('userName', $userName)->firstOrFail();

        $posts = Post::where('user_id', $user->id)->whereNotNull('title')->whereNotNull('slug')->get();

        return view('home')->with('posts', $posts);
    }

    public function myEmptyPosts($userName)
    {
        $user = User::where('userName', $userName)->firstOrFail();

        $posts = Post::where('user_id', $user->id)->whereNull('title')->whereNull('slug')->get();

        return view('home')->with('posts', $posts);
    }

    public function followers($userName)
    {
        $user = User::where('userName', $userName)->firstOrFail();

        return view('followers')->with('user', $user);
    }

    public function followings($userName)
    {
        $user = User::where('userName', $userName)->firstOrFail();

        return view('followings')->with('user', $user);
    }


}
