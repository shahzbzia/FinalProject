@extends('layouts.app')

@section('content')
<div class="container w-full mt-3">

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

  <!-- Profile Card -->
  <div class="shadow-lg bg-gray-600 flex p-3 antialiased" style="
    background-image: url({{ $coverImage }});
    background-repeat: no-repat;
    background-size: cover;
    background-blend-mode: multiply;
  ">
    <div class="md:w-1/4 w-full">
      <img class="rounded-lg antialiased border-2" src="{{ $userImage }}" alt="">
    </div>
  </div>
  <!-- End Profile Card -->

  <div class="bg-white border border-t-0 border-red-400 bg-white px-4 py-3 text-black mb-5 shadow-lg">
  
    <div class="mt-3">
      <span class="uppercase text-base font-semibold">Personal Information</span>
      <hr>
    </div>

    <div class="text-base mt-2">

      <div>
        <strong>First Name:</strong><span> {{ $user->firstName }}</span>
      </div>
      
      <div class="mt-3">
        <strong>Last Name:</strong><span> {{ $user->lastName }}</span>
      </div>

      <div class="mt-3">
        <strong>User Name:</strong><span> {{ $user->userName }}</span>
      </div>
      
      <div class="mt-3">
        <strong>Gender:</strong><span> {{ $user->gender->gender_name }}</span>
      </div>

      <div class="mt-3">
        <strong>Date of birth:</strong><span> {{ $user->birthDate->format('d-m-Y') }} ({{ \Carbon\Carbon::parse($user->birthDate)->age }} years old) </span>
      </div>

      <div class="mt-3">
        <strong>Profession:</strong><span> {{ $user->profession }} </span>
      </div>

      <div class="mt-3">
        <strong>About Me:</strong><span> {{ $user->aboutMe }} </span>
      </div>

    </div>

    <div class="mt-3">
      <span class="uppercase text-base font-semibold">Contact Information</span>
      <hr>
    </div>

    <div class="mt-3">
      <strong>Email:</strong><span> {{ $user->email }}</span>
    </div>

    <div class="mt-3">
      <strong>Phone Number:</strong><span> {{ $user->countryCode }} {{ $user->number }}</span>
    </div>

    <div class="mt-3">
      <span class="uppercase text-base font-semibold">Followers</span>
      <hr>
    </div>

    <div>
      <div>
        <div class="flex flex-wrap justify-start">
          @for ($i = 0; $i < 4; $i++)
            <div class="flex md:flex-1 my-1 mt-3">
              <div>
                <img class="rounded-lg antialiased" width="50" src="{{ $userImage }}" alt="">
              </div>
              <div class="ml-2 text-xs">
                <p>{{ $user->userName }}</p>
                <p>{{ $user->profession }}</p>
              </div>
            </div>
          @endfor
        </div>

        <div class="flex justify-center mt-3">
          <button href="" class="items-center bg-{{ $user->theme->value }}-500 rounded p-2 text-xs text-white text-center">
            See All
          </button>
        </div>
    </div>


    <div class="mt-3">
      <span class="uppercase text-base font-semibold">Following</span>
      <hr>
    </div>

    <div>
      <div>
        <div class="flex flex-wrap justify-start">
          @for ($i = 0; $i < 4; $i++)
            <div class="flex md:flex-1 my-1 mt-3">
              <div>
                <img class="rounded-lg antialiased" width="50" src="{{ $userImage }}">
              </div>
              <div class="ml-2 text-xs">
                <p>{{ $user->userName }}</p>
                <p>{{ $user->profession }}</p>
              </div>
            </div>
          @endfor
        </div>

        <div class="flex justify-center mt-3">
          <button href="" class="items-center bg-{{ $user->theme->value }}-500 rounded p-2 text-xs text-white text-center">
            See All
          </button>
        </div>
    </div>
    

    <div class="mt-3">
      <span class="uppercase text-base font-semibold">Themes</span>
      <hr>
    </div>

    <div class="text-base mt-2">
      <div>
        <strong>Theme:</strong><span class="uppercase"> {{ $user->theme->name }}</span>
      </div>
    </div>

    <div class="mt-4 flex justify-between">
      <a class="hover:no-underline bg-{{ $user->theme->value }}-500 hover:bg-{{ $user->theme->value }}-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{ route('user.showUserEditForm') }}">
          Edit Profile
      </a>

      <a href="{{ route('home') }}" class="bg-{{ $user->theme->value }}-500 hover:bg-{{ $user->theme->value }}-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:no-underline">
          Home
      </a>
    </div>

  </div>

</div>
  
</div>
@endsection