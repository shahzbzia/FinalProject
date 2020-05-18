@extends('layouts.app')

@section('content')
	<div class="container mt-2">

		<div class="p-3 bg-black rounded-t block md:flex md:justify-between">
            <h5 class="text-white text-sm">{{ $post->title }}</h5>
            <p class="text-xs font-light text-gray-600">posted by <a href="{{ route('user.profile', $post->user->userName) }}">{{ $post->user->userName }}</a> {{ $post->created_at->diffForHumans() }}</p>
        </div>

		@if ($post->getMedia('images')->first())
            <img class="h-full w-full object-cover" src="{{ $post->getMedia('images')->first()->getUrl('watermarked') }}">
        @endif

        @if ($post->getMedia('video')->first())
            <video class="h-full w-full object-cover" controls controlsList="nodownload">
                <source src="{{asset($post->getMedia('video')->first()->getUrl())}}" type="{{ $post->getMedia('video')->first()->mime_type }}">
            </video>
        @endif

        <div class="block bg-white py-1 rounded-lg border border-black shadow-lg">
            <div class="flex flex-row justify-between my-1 ml-2 mr-2">

                <div class="flex flex-row">
                    <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(1)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} up-vote mr-1 fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                        <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                    </svg>
                    </a>

                    <p id="{{ $post->id.'vote-counts-small' }}" class="vote-count text-sm mr-1">{{ $post->getTotalVoteCount() }}</p>

                    <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(0)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} down-vote fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                        <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                    </svg></a>
                </div>

                <div class="flex flex-row">
                    <a class="mr-2" href=""><svg class="fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                    <p class="text-sm">245</p>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white rounded-t block md:flex md:justify-between mt-3 border">
            <h5 class="text-black text-sm font-semibold">Comments (245)</h5>
        </div>

        <div class="p-3 bg-white rounded-t block mb-3 shadow-lg rounded-lg">
        	@auth
				
				<form action="">
	        		@csrf
	        		<p>commenting as <a href="{{ route('user.profile', $post->user->userName) }}">{{ $post->user->userName }}</a></p>
		        	<textarea name="aboutMe" rows="5" cols="50" id="aboutMe" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('aboutMe') bg-red-200 @enderror" >Share your thought!</textarea>
		        	<div class="flex justify-end"><button class="p-2 bg-blue-500 hover:bg-blue-700 rounded-lg text-xs text-white items-end" type="submit">Submit</button></div>
	        	</form>

	        @else

	        	<p><a href="">Signup</a> or <a href="">Login</a> to write a comment.</p>

        	@endauth
			
			<div class="mt-3">
				@php
					$pathImage = (Auth::user()->image) ? asset("storage/".Auth::user()->image) : asset('/images/blank-profile.png');

					if(App::environment('production')) {
					$pathImage = (Auth::user()->image) ? asset("storage/app/public/".Auth::user()->image) : asset('/public/images/blank-profile.png');
					}
				@endphp
				<div class="flex">
					<img class="mr-2" src="{{ $pathImage }}" width="50" height="50">
					<div>
						<p>{{ $post->user->userName }} | 5 hours ago</p>
						<p>Shahzaib Zia is a genius.</p>
					</div>
				</div>


			</div>

        </div>

	</div>



<script>
    $(function() {
        $('.up-vote').on('click', function(event) {
            event.preventDefault();
            var _token = '{{ Session::token() }}';
            var upPostId = $(this).attr("post-id");
            
            $(this).toggleClass("text-{{ Auth::user()->theme->value }}-500");
            if($(this).hasClass("text-{{ Auth::user()->theme->value }}-500"))
            {
                $('.down-vote').removeClass("text-{{ Auth::user()->theme->value }}-500");
            }
            $.ajax({
                method: 'POST',
                url: '{{ route('upVotePost') }}',
                data: {postId: upPostId, _token: _token }
            })
             .done(function(data){
                $('#' + upPostId + 'vote-counts').text(data.votesCount);
                $('#' + upPostId + 'vote-counts-small').text(data.votesCount);
             });  
        });

        $('.down-vote').on('click', function(event) {
            event.preventDefault();
            var _token = '{{ Session::token() }}';
            var downPostId = $(this).attr("post-id");
            $(this).toggleClass("text-{{ Auth::user()->theme->value }}-500");
            if($(this).hasClass("text-{{ Auth::user()->theme->value }}-500"))
            {
                $('.up-vote').removeClass("text-{{ Auth::user()->theme->value }}-500");
            }
            $.ajax({
                method: 'POST',
                url: '{{ route('downVotePost') }}',
                data: {postId: downPostId, _token: _token }
            })
             .done(function(data){
                $('#' + downPostId + 'vote-counts').text(data.votesCount);
                $('#' + downPostId + 'vote-counts-small').text(data.votesCount);
             });  
        });
    });

</script>
@endsection