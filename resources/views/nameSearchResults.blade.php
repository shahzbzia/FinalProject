@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Search results for {{ $query }}</div>
                @if (!$users->isEmpty())
                    @foreach ($users as $user)
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
                    
                        <a href="{{ route('user.profile', $user->userName) }}">   
                            <div class="card-body">
                                <div class="flex flex-wrap">
                                    <div class=" flex mx-1 my-1">
                                        <div>
                                            <img class="rounded-lg antialiased" width="50" src="{{ $userImage }}" alt="">
                                        </div>
                                        <div class="ml-2 text-xs">
                                            <p>{{ $user->firstName }} {{ $user->lastName }}</p>
                                            <p>{{ ($user->profession) ? $user->profession : 'Artist' }}</p>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                        </a>
                    @endforeach
                    
                    @else
                        <div class="card-body">
                            <h5>Sorry, no results matching <strong>"{{ $query }}"</strong> were found!</h5>
                        </div>
                @endif

                
            </div>
        </div>
    </div>
</div>
@endsection
