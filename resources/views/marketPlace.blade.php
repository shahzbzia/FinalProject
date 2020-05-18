@extends('layouts.app')

@section('content')
<div class="container flex flex-wrap flex-1">
    
    @foreach ($posts as $post)
        <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden my-3 align-middle @auth mx-3 @else mx-3 mx-auto lg:w-1/4 @endauth">
            <div class="px-3 py-2 mt-2 flex justify-between">
                <h1 class="text-gray-900 font-bold text-base uppercase">{{ $post->title }}</h1>
                <a href="{{ route('user.profile', $post->user->userName) }}"><p class="font-light text-xs">{{ $post->user->userName }}</p></a>  

                {{-- <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi quos quidem sequi illum facere recusandae voluptatibus</p> --}}
            </div>
            @if ($post->getMedia('images')->first())
                <img class="h-56 w-full object-cover mt-2" src="{{ $post->getMedia('images')->first()->getUrl('watermarked') }}">
            @endif

            @if ($post->getMedia('video')->first())
                <video class="h-56 w-full object-cover mt-2" controls controlsList="nodownload">
                    <source src="{{asset($post->getMedia('video')->first()->getUrl())}}" type="{{ $post->getMedia('video')->first()->mime_type }}">
                </video>
            @endif
            <div class="flex items-center justify-between px-4 py-2 bg-black">
                <h1 class="text-gray-200 font-bold text-xl">${{ $post->royaltyFee }}</h1>
                <button class="px-3 py-1 bg-gray-200 text-sm text-gray-900 font-semibold rounded">Add to card</button>
            </div>
        </div>
    @endforeach

</div>
@endsection