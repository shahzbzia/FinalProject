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
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, RegisterRequest::$rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
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
