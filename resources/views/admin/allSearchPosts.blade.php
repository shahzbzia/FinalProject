@extends('layouts.app')

@section('content')
<div class="container">
	
	@foreach ($posts as $post)
	              
	                @if ($post->title && $post->slug)
	                  @php
	                      $pathImage = ($post->user->image) ? asset("storage/".$post->user->image) : asset('/images/blank-profile.png');
	                  @endphp
	          
	                    <div class="w-full md:w-4/5 align-middle mx-auto mb-4 mt-4" >
	                        <div class="max-w-sm w-full md:max-w-full lg:flex">


	                            @if ($post->getMedia('images')->first())
	                                <div class="h-48 lg:h-48 lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ $post->getMedia('images')->first()->getUrl('watermarked') }}')">
	                                </div>
	                            @endif

	                             @if ($post->getMedia('video')->first())
	                                <div class="sm:h-32 md:h-48 lg:h-auto lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
	                                    <video controls controlsList="nodownload">
	                                        <source src="{{asset($post->getMedia('video')->first()->getUrl())}}" type="{{ $post->getMedia('video')->first()->mime_type }}">
	                                    </video>
	                                </div>
	                            @endif

	                            <a class="hover:no-underline" href="{{ route('post.show', $post->slug) }}">
	                                <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-3 flex flex-col justify-between leading-normal w-full min-h-64">
	                                    <div class="mb-3 ml-2">
	                                        <input type="hidden" class="post-id" value="{{ $post->id }}">
	                                        <div class="text-gray-900 font-bold text-base mb-2">{{ $post->title }}</div>
	                                        <div class="flex">
	                                            <p class="text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 50) }}</p>
	                                            @if (strlen(strip_tags($post->description)) > 50)
	                                                <a href="{{ route('post.show', $post->slug) }}" class="text-xs ml-3">Read More</a>
	                                            @endif
	                                        </div>
	                                    </div>
	                                    <div class="flex justify-start ml-2">
	                                        <a href="{{ route('user.profile', $post->user->userName) }}" class="hover:no-underline">
	                                            <div class="flex items-center">
	                                                <img class="w-10 h-10 rounded-full mr-2" src="{{ $pathImage }}">
	                                                <div class="text-xs">
	                                                    <p class="text-gray-900 font-semibold leading-none">{{ $post->user->userName }}</p>
	                                                    <p class="text-gray-600 text-xs">{{ ($post->created_at)->diffForhumans() }}</p>
	                                                </div>
	                                            </div>

	                                            @if (Route::currentRouteName() == 'all.posts')
													<div class="ml-32 md:ml-64 lg:ml-72">
														<a href="{{ route('post.deleteByAdmin', $post->id) }}" class="mt-2 ml-2 px-2 text-red-600 font-semibold border-2 border-red-600 rounded-lg hover:bg-red-600 hover:text-black hover:no-underline hover:text-white">Delete</a>
													</div>
												@endif
	                                        </a>
	                                    </div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>         
	              @endif
	            @endforeach

	@if (Route::currentRouteName() == 'all.posts')
		<div class="flex justify-center">
			{{ $posts->links() }}
		</div>
	@endif

</div>
@endsection