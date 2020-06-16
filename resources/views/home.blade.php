@extends('layouts.app')

@section('content')


<div class="container">
    @php

        $themeText = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-500' : 'text-gray-800';

        $themeTextHover = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-700' : 'text-black';

        $themeBg = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-500' : 'bg-gray-800';

        $themeBgHover = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-700' : 'bg-black';

    @endphp

    @if (Route::currentRouteName() == 'home')
        
        <div id="lazyLoadedPosts">

        </div>

    @endif
    

    
    @if (Route::currentRouteName() != 'home')
    

        @foreach ($posts as $post)

            @php
                $pathImage = ($post->user->image) ? asset("storage/".$post->user->image) : asset('/images/blank-profile.png');
            @endphp   
                
            <div class="w-full md:w-4/5 align-middle mx-auto mb-4" >
                <div class="max-w-sm w-full md:max-w-full lg:flex">

                    {{-- upVoteS DownVoteS POSTS FOR LARGE SCREENS --}}
                    @auth
                        <div class="sm:hidden lg:flex flex-col justify-around mr-2">
                            <div class="hidden lg:flex flex-col">
                                <a href="#"><svg id="{{ 'up-vote-' . $post->id }}" class="{{ ($post->checkIfUserHasVoted(1)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} up-vote sm:mr-1 lg:mr-0 fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                                    <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                                </svg>
                                </a>

                                <p id="{{ $post->id.'vote-counts' }}" class="vote-count text-center text-xs sm:mr-1 lg:mr-0">{{ $post->getTotalVoteCount() }}</p>

                                <a href="#"><svg id="{{ 'down-vote-' . $post->id }}" class="{{ ($post->checkIfUserHasVoted(0)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} down-vote fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                                    <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                                </svg></a>
                            </div>

                            <div class="hidden lg:flex flex-col">
                                <a class="sm:mr-2 lg:mr-0" href="{{ (Route::currentRouteName() == 'my.emptyPosts') ? '' : route('post.show', $post->slug) }}"><svg class=" fill-current hover:{{ $themeText }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                                <p class="text-sm text-center">{{ $post->comments()->count() }}</p>
                            </div>
                        </div>
                    @endauth


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

                    <a class="hover:no-underline overflow-hidden" href="{{ (Route::currentRouteName() == 'my.emptyPosts') ? '' : route('post.show', $post->slug) }}">
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-3 flex flex-col justify-between leading-normal w-full min-h-64">
                            <div class="mb-3 ml-2">
                                <input type="hidden" class="post-id" value="{{ $post->id }}">
                                <div class="text-gray-900 font-bold text-base mb-2">{{ $post->title }}</div>
                                <div class="flex">
                                    <p class="text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 50) }}</p>
                                    @if (strlen(strip_tags($post->description)) > 50)
                                        <a href="{{ (Route::currentRouteName() == 'my.emptyPosts') ? '' : route('post.show', $post->slug) }}" class="text-xs ml-3">Read More</a>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-start ml-2">
                                <a href="{{ route('user.profile', $post->user->userName) }}" class="hover:no-underline">
                                    <div class="flex items-center">
                                        <img class="w-14 h-10 rounded-full mr-2" src="{{ $pathImage }}">
                                        <div class="text-xs">
                                            <p class="text-gray-900 font-semibold leading-none">{{ $post->user->userName }}</p>
                                            <p class="text-gray-600 text-xs">{{ ($post->created_at)->diffForhumans() }}</p>
                                        </div>
                                    </div>
                                </a>

                                {{-- <div class="">
                                    <button class="{{ $themeBg }} hover:{{ $themeBgHover }} text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center">
                                        <span>Follow</span>
                                    </button> 
                                </div> --}}
                            </div>

                            
                        </div>
                    </a>
                </div>

                {{-- upVoteS DIS-upVoteS POSTS FOR SMALL SCREENS --}}
                @auth
                    <div class="block lg:hidden bg-white py-1 rounded-lg border border-black">
                        <div class="flex lg:hidden flex-row justify-between my-1 ml-2 mr-2">

                            <div class="flex lg:hide flex-row">
                                <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(1)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} up-vote mr-1 fill-current hover:{{ $themeTextHover }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                                    <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                                </svg>
                                </a>

                                <p id="{{ $post->id.'vote-counts-small' }}" class="vote-count text-sm mr-1">{{ $post->getTotalVoteCount() }}</p>

                                <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(0)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} down-vote fill-current hover:{{ $themeTextHover }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                                    <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                                </svg></a>
                            </div>

                            <div class="flex lg:hide flex-row">
                                <a class="mr-2" href="{{ (Route::currentRouteName() == 'my.emptyPosts') ? '' : route('post.show', $post->slug) }}"><svg class="fill-current hover:{{ $themeTextHover }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                                <p class="text-sm">{{ $post->comments()->count() }}</p>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        

                @if (Route::currentRouteName() == 'my.emptyPosts')
                    <div class="flex">
                        <a class="align-middle mx-auto px-4 py-2 mb-4 rounded-lg text-white font-semibold bg-blue-600 hover:no-underline" href="{{ route('editPost', $post->id) }}">Edit</a>

                        <button class="align-middle mx-auto px-4 py-2 mb-4 rounded-lg text-white font-semibold bg-red-600" onclick="handleDelete({{ $post->id }})">Delete</button>
                    </div>

                    <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form action="{{ route('deletePost', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this post? This action can't be undone!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                              </div>
                            </div>
                        </form>
                      </div>
                    </div>   
                @endif

        @endforeach
    @endif
</div>

<script>
    $(function() {
        $('.up-vote').on('click', function(event) {
            event.preventDefault();
            var _token = '{{ Session::token() }}';
            var upPostId = $(this).attr("post-id");
            
            $(this).toggleClass("{{ $themeText }}");
            if($(this).hasClass("{{ $themeText }}"))
            {
                $('#down-vote-'+ upPostId).removeClass("{{ $themeText }}");
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
            $(this).toggleClass("{{ $themeText }}");
            if($(this).hasClass("{{ $themeText }}"))
            {
                $('#up-vote-'+ downPostId).removeClass("{{ $themeText }}");
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

<script>
    
    function handleDelete(id)
    {
        //console.log('deleting', id);
        $('#deletePostModal').modal('show');   
    }

</script>

<script>

    var page = 1;

    load_more(page);

    $(window).scroll(function() { 

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          load_more(page);
      }

    });     

    function load_more(page){

        $.ajax({

           url: '?page=' + page,
           type: "get",
           datatype: "html",

        })

        .done(function(data)
        {
            $("#lazyLoadedPosts").append(data);      
            //console.log(data);
       })

       .fail(function(jqXHR, ajaxOptions, thrownError)
       {
          alert('No response from server. Please try again later.');
       });

    }

</script>
@endsection