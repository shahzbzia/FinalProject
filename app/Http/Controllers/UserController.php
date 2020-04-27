<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Theme;
use App\Gender;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{

	public function ownProfile($id)
    {
        $user = User::whereId($id)->firstOrFail();
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


}
