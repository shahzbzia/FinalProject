@extends('layouts.app')

@section('content')
<div class="container">

    <div class="align-middle mx-auto mt-4 @guest w-full lg:w-3/5 xl:w-3/5 @else w-full lg:w-4/5 xl:w-4/5 @endif">

        <h2 class="text-2xl @auth text-{{$user->theme->value}}-500 @else text-black @endauth font-bold tracking-widest uppercase font-mono mb-2 ml-4">{{ isset($user) ? 'Edit Profile' : 'Sign Up' }}</h2>

        <form class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ isset($user) ? route('user.update', Auth::user()->id) : route('register') }}" enctype="multipart/form-data">

            @csrf

            @if(isset($user))
                @method('PUT')
            @endif

            <div class="flex justify-between">
                <h5 class="text-base font-bold">Personal Informaton</h5>

                @guest
                    <p class="text-sm"><span class="text-red-500">*</span> required</p>
                @endguest
            </div>

            <hr class="mt-2 mb-3">

            <div class="flex flex-col md:flex-row lg:flex-row xl:flex-row justify-between">
                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                        First Name @guest <span class="text-red-500">*</span> @endguest
                    </label>

                    <input id="firstName" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('firstName') bg-red-200 @enderror" name="firstName" value="{{ isset($user) ? $user->firstName : old('firstName') }}" required autocomplete="firstName" placeholder="Ben" autofocus>

                    @error('firstName')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                        Last Name @guest <span class="text-red-500">*</span> @endguest
                    </label>

                    <input id="lastName" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lastName') bg-red-200 @enderror" name="lastName" value="{{ isset($user) ? $user->lastName : old('lastName') }}" required autocomplete="lastName" placeholder="Dover" autofocus>

                    @error('lastName')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            @guest

                <div class="mb-4 w-full">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="userName">
                        User name @guest <span class="text-red-500">*</span> @endguest
                    </label>

                    <input id="userName" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('userName') bg-red-200 @enderror" name="userName" value="{{ isset($user) ? $user->userName : old('userName') }}" required autocomplete="userName" placeholder="doverben98" autofocus>

                    @error('userName')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

            @endguest

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="birthDate">
                    Date of birth @guest <span class="text-red-500">*</span> @endguest
                </label>

                <input id="birthDate" type="date" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('birthDate') bg-red-200 @enderror" name="birthDate" value="{{ isset($user) ? $user->birthDate->format('Y-m-d') : old('birthDate') }}"  required autocomplete="birthDate" autofocus>

                @error('birthDate')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <label class="w-full text-gray-700 text-sm font-semibold mb-2" for="gender_id">

                    Gender @guest <span class="text-red-500">*</span> @endguest

                </label>

                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-3 py-2 pr-8 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline @error('gender_id') bg-red-200 @enderror" name="gender_id" id="gender_id" required autofocus>

                    @foreach ($genders as $g)
                        <option value="{{ $g->id }}"
                            
                            @if (isset($user))

                                @if ($g->id === $user->gender_id)

                                    selected

                                @endif

                            @endif

                            >

                            {{ $g->gender_name }}

                        </option>

                    @endforeach

                </select>

            

            </div>

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="profession">
                    Profession
                </label>

                <input id="profession" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('profession') bg-red-200 @enderror" name="profession" value="{{ isset($user) ? $user->profession : old('profession') }}" autocomplete="profession" placeholder="Artist" autofocus>

                @error('profession')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-semibold mb-2" for="aboutMe">

                    About Me

                </label>

                <textarea name="aboutMe" rows="2" cols="50" id="aboutMe" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('aboutMe') bg-red-200 @enderror" >{{ isset ($user) ? $user->aboutMe : old('aboutMe') }} </textarea>

                @error('aboutMe')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <h5 class="text-base font-bold">Contact Details</h5>

            <hr class="mt-2 mb-3">
            
            @guest
                <div class="mb-4">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email  <span class="text-red-500">*</span> 
                    </label>

                    <input id="email" type="email" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-200 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@gmail.com" autofocus>

                    @error('email')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            @endguest

            <div class="flex flex-col md:flex-row lg:flex-row xl:flex-row justify-between">
                <div class="mb-4 w-full md:w-1/6 lg:w-1/6 xl:w-1/6">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="countryCode">
                        Country Code @guest <span class="text-red-500">*</span> @endguest
                    </label>

                    <input id="countryCode" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('countryCode') bg-red-200 @enderror" name="countryCode" value="{{ isset($user) ? $user->countryCode : old('countryCode') }}" required autocomplete="countryCode" placeholder="+32" autofocus>

                    @error('countryCode')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <p class="mt-8 hidden md:block lg:block xl:block">-</p>
                    
                <div class="mb-4 w-full md:w-9/12 lg:w-9/12 xl:w-9/12">

                    <div class="flex">

                        <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                            Phone Number @guest <span class="text-red-500">*</span> @endguest
                        </label>

                        <p class="text-gray-500 ml-1 text-xs mt-1">(without the first 0)</p>

                    </div>

                    <input id="number" type="number" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('number') bg-red-200 @enderror" name="number" value="{{ isset($user) ? $user->number : old('number') }}" required autocomplete="number" placeholder="487944118" autofocus>

                    @error('number')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-semibold mb-2" for="address">

                    Address @guest <span class="text-red-500">*</span> @endguest

                </label>

                <textarea name="address" rows="2" cols="50" id="address" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') bg-red-200 @enderror" > {{ isset ($user) ? $user->address : old('address') }} </textarea>

                @error('address')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <h5 class="text-base font-bold">Photos</h5>

            <hr class="mt-2 mb-3">

            @auth
                <div class="hidden md:flex lg:flex xl:flex">

                    @php
                        $coverImage = ($user->coverImage) ? asset("storage/".$user->coverImage) : asset('/images/plain-cover.jpg');

                        if(App::environment('production')) {
                          $coverImage = ($user->coverImage) ? asset("storage/app/public/".$user->coverImage) : asset('/public/images/plain-cover.jpg');
                        }

                        $userImage = ($user->image) ? asset("storage/".$user->image) : asset('/images/blank-profile.png');

                        if(App::environment('production')) {
                          $userImage = (Auth::user()->image) ? asset("storage/app/public/".$user->image) : asset('/public/images/blank-profile.png');
                        }
                    @endphp

                    <div>

                        <img class="mb-3" width="100" height="100" src="{{ $userImage }}" alt="">
                            
                    </div>
                    
                    <div class="md:ml-49 lg:ml-83 xl:ml-83">

                        <img class="mb-3" width="100" height="100" src="{{ $coverImage }}" alt="">
                           
                    </div>
                </div>
            @endauth

            <div class="flex flex-col md:flex-row lg:flex-row xl:flex-row justify-between">
                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    @auth
                        
                        <div class="block md:hidden lg:hidden xl:hidden">
                            <img class="mb-3" width="50" height="50" src="{{ $userImage }}">
                        </div>

                    @endauth

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Profile Picture
                    </label>

                    <input id="image" type="file" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') bg-red-200 @enderror" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>

                    @error('image')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    @auth

                        <div class="block md:hidden lg:hidden xl:hidden">
                            <img class="mb-3" width="50" height="50" src="{{ $coverImage }}">
                        </div>

                    @endauth

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="coverImage">
                        Cover Picture
                    </label>

                    <input id="coverImage" type="file" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('coverImage') bg-red-200 @enderror" name="coverImage" value="{{ old('coverImage') }}" autocomplete="coverImage" autofocus>

                    @error('coverImage')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="flex justify-between">
                <h5 class="text-base font-bold">Theme</h5>
            </div>

            <hr class="mt-2 mb-3">

            <div class="mb-4">

                <label class="w-full text-gray-700 text-sm font-semibold mb-2" for="theme_id">

                    Select Theme

                </label>

                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-3 py-2 pr-8 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline @error('theme_id') bg-red-200 @enderror" name="theme_id" id="theme_id" required autofocus>

                    @foreach ($themes as $t)
                        <option value="{{ $t->id }}"
                            
                            @if (isset($user))

                                @if ($t->id === $user->theme_id)

                                    selected

                                @endif

                            @endif

                            >

                            {{ $t->name }}

                        </option>

                    @endforeach

                </select>

            

            </div>  


            @guest 


            <div class="flex justify-between">
                <h5 class="text-base font-bold">Password</h5>
            </div>

            <hr class="mt-2 mb-3">

            
            <div class="flex flex-col md:flex-row lg:flex-row xl:flex-row justify-between">
                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input id="password" type="password" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-200 @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" placeholder="minimum 8 letters" autofocus>

                    @error('password')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-6 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password-confirm">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>

                    <input id="password-confirm" type="password" class="shadow-md appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password-confirm ') bg-red-200 @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="minimum 8 letters">

                    @error('password')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            @endguest

            <div class="flex items-center justify-between">

                <button class="@auth bg-{{$user->theme->value}}-500 hover:bg-{{$user->theme->value}}-700 @else bg-black hover:bg-gray-700 @endauth text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ isset($user) ? 'Save' : 'Lets GO!' }}
                </button>

            </div>

        </form>

    </div>

</div>
@endsection
