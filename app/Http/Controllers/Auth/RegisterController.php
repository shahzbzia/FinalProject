<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Theme;
use App\Gender;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Register\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {

        $themes = Theme::all();
        $genders = Gender::all();

        return view('auth.register')
            ->with('themes', $themes)
            ->with('genders', $genders);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, RegisterRequest::$rules);
    }

    protected function create(array $data)
    {
        
        $user =  User::create([
            'firstName' => $data['firstName'], 
            'lastName'  => $data['lastName'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'countryCode' => $data['countryCode'], 
            'number' => $data['number'], 
            'theme_id' => $data['theme_id'], 
            'address' => $data['address'], 
            'gender_id' => $data['gender_id'], 
            'birthDate' => $data['birthDate'], 
            'profession' => $data['profession'], 
            'aboutMe' => $data['aboutMe'],
            'userName' => $data['userName']
        ]);

        if(request()->hasFile('image')) {
            $image = request()->file('image')->store('profile', 'public');
            $user->update(['image' => $image]);
        }

        if(request()->hasFile('coverImage')) {
            $coverImage = request()->file('coverImage')->store('profile', 'public');
            $user->update(['coverImage' => $coverImage]);
        }

        return $user;
    }
}
