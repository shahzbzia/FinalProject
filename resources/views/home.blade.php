@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)

    @php
        $pathImage = ($post->user->image) ? asset("storage/".$post->user->image) : asset('/images/blank-profile.png');

        if(App::environment('production')) {
          $pathImage = ($post->user->image) ? asset("storage/app/public/".$post->user->image) : asset('/public/images/blank-profile.png');
        }
    @endphp

    
        <div class="w-full md:w-4/5 align-middle mx-auto mb-4" >
            <div class="max-w-sm w-full md:max-w-full lg:flex">

                {{-- upVoteS DownVoteS POSTS FOR LARGE SCREENS --}}
                <div class="sm:hidden lg:flex flex-col justify-around mr-2">
                    <div class="hidden lg:flex flex-col">
                        <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(1)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} up-vote sm:mr-1 lg:mr-0 fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                            <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                        </svg>
                        </a>

                        <p id="{{ $post->id.'vote-counts' }}" class="vote-count text-center text-xs sm:mr-1 lg:mr-0">{{ $post->getTotalVoteCount() }}</p>

                        <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(0)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} down-vote fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                            <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                        </svg></a>
                    </div>

                    <div class="hidden lg:flex flex-col">
                        <a class="sm:mr-2 lg:mr-0" href=""><svg class=" fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                        <p class="text-sm">245</p>
                    </div>
                </div>


                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ $post->getMedia('posts')->first()->getUrl('watermarked') }}')" title="Woman holding a mug">
                </div>

                <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                    <div class="mb-8">
                        <input type="hidden" class="post-id" value="{{ $post->id }}">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $post->title }}</div>
                        <p class="text-gray-700 text-base">{{ $post->description }}</p>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full mr-4" src="{{ $pathImage }}" alt="Avatar of Jonathan Reinink">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none">{{ $post->user->userName }}</p>
                                <p class="text-gray-600">{{ ($post->created_at)->diffForhumans() }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <button class="bg-{{ Auth::user()->theme->value }}-500 hover:bg-{{ Auth::user()->theme->value }}-700 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center">
                                <span>Follow</span>
                            </button> 

                            <a class="mt-1" href="">See more</a>  
                        </div>
                    </div>

                    
                </div>
            </div>

            {{-- upVoteS DIS-upVoteS POSTS FOR SMALL SCREENS --}}
            <div class="block lg:hidden bg-white py-1 rounded-lg border border-black">
                <div class="flex lg:hidden flex-row justify-between my-1 ml-2 mr-2">

                    <div class="flex lg:hide flex-row">
                        <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(1)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} up-vote mr-1 fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                            <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                        </svg>
                        </a>

                        <p id="{{ $post->id.'vote-counts-small' }}" class="vote-count text-sm mr-1">{{ $post->getTotalVoteCount() }}</p>

                        <a href="#"><svg id="iconmonstr" class="{{ ($post->checkIfUserHasVoted(0)) ? 'text-' . Auth::user()->theme->value . '-500' : '' }} down-vote fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                            <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                        </svg></a>
                    </div>

                    <div class="flex lg:hide flex-row">
                        <a class="mr-2" href=""><svg class="fill-current hover:text-{{ Auth::user()->theme->value }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                        <p class="text-sm">245</p>
                    </div>
                </div>
            </div>
        </div>    
    @endforeach
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