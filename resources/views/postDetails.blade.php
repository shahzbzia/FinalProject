@extends('layouts.app')

@section('content')
	<div class="container mt-2">

        @php

            $themeText = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-500' : 'text-gray-800';

            $themeTextHover = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-700' : 'text-black';

            $themeBg = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-500' : 'bg-gray-800';

            $themeBgHover = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-700' : 'bg-black';

        @endphp

		<div class="p-3 bg-black rounded-t block md:flex md:justify-between">
            <h5 class="text-white text-sm">{{ $post->title }}</h5>
            <p class="text-xs font-light text-gray-600">posted by <a href="{{ route('user.profile', $post->user->userName) }}">{{ $post->user->userName }}</a> {{ $post->created_at->diffForHumans() }}</p>

            @if ($post->user_id == Auth::user()->id)
                <div class="text-white">
                    <a class="mr-2 hover:no-underline hover:text-white" href="{{ route('editPost', $post->id) }}">Edit</a>
                    <button class="hover:no-underline hover:text-white" onclick="handleDelete({{ $post->id }})">Delete</button>
                </div>
            @endif
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

            @if ($post->description)
                <div class="p-3">
                    <strong>Description:</strong> {{ $post->description }}
                </div>
            @endif


            <div class="flex flex-row justify-between my-1 ml-2 mr-2">

                <div class="flex flex-row">
                    <a href="#"><svg id="iconmonstr" class=" @auth {{ ($post->checkIfUserHasVoted(1)) ? 'text-' . $themeText . '-500' : '' }} @endauth up-vote mr-1 fill-current hover:text-{{ $themeTextHover }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                        <path id="arrow-48" class="cls-1" d="M2.975,14l4-.013L11.95,5.946l5.026,8.006,4-.013L11.931-.031Zm8.987-4.029L21.007,23.94,3.007,24Z"/>
                    </svg>
                    </a>

                    <p id="{{ $post->id.'vote-counts-small' }}" class="vote-count text-sm mr-1">{{ $post->getTotalVoteCount() }}</p>

                    <a href="#"><svg id="iconmonstr" class=" @auth {{ ($post->checkIfUserHasVoted(0)) ? 'text-' . $themeText . '-500' : '' }} @endauth down-vote fill-current hover:text-{{ $themeTextHover }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" post-id="{{ $post->id }}">
                        <path id="arrow-48" d="M20.994,9.971l-4,.013-4.974,8.038L6.994,10.016l-4,.013L12.038,24ZM12.006,14L2.962,0.029l18-.057Z"/>
                    </svg></a>
                </div>

                <div class="flex flex-row">
                    <a class="mr-2" href=""><svg class="fill-current hover:text-{{ $themeTextHover }}-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"/></svg></a>

                    <p class="text-sm">{{ $post->comments()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white rounded-t block md:flex md:justify-between mt-3 border">
            <h5 class="text-black text-sm font-semibold">Comments ({{ $post->comments()->count() }})</h5>
        </div>

        <div class="p-3 bg-white rounded-t block mb-3 shadow-lg rounded-lg">
        	@auth
				
				<form id="form-comment" action="" method="POST">

	        		@csrf

                    <input type="hidden" id="post-id" value="{{ $post->id }}">

	        		<p>commenting as <a href="{{ route('user.profile', $post->user->userName) }}">{{ $post->user->userName }}</a></p>

		        	<textarea name="comment" rows="5" cols="50" id="comment-textarea" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') bg-red-200 @enderror" >Share your thoughts!</textarea>

		        	<div class="flex justify-end">
                        <button class="p-2 bg-blue-500 hover:bg-blue-700 rounded-lg text-xs text-white items-end" type="submit">Comment</button>
                    </div>
	        	</form>

	        @else

	        	<p class="text-center mt-2"><a href="{{ route('register') }}"><strong>Signup</strong></a> or <a href="{{ route('login') }}"><strong>Login</strong></a> to write a comment.</p>

        	@endauth
			
			<div class="mt-3 comment-section">
				
                @if ($post->comments()->count() > 0)
                    @foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                        <div id="{{ $comment->id.'single-comment' }}" class="flex mb-4">
                            {{-- <input class="comment-id" type="hidden" value="{{ $comment->id }}"> --}}
                            <img class="mr-2 absolute" src="{{ ($comment->user->image) ? asset('storage/'.$comment->user->image) : asset('/images/blank-profile.png') }}" width="50" height="50">
                            <div>
                                <div class="ml-16">
                                    <p>{{ $comment->user->userName }} | {{ $comment->created_at->diffForHumans() }}</p>
                                    <p id="{{ $comment->id.'comment-val' }}" class="text-base">{{ $comment->body }}</p>
                                </div>

                                @auth
                                    @if (Auth::user()->id == $comment->user->id)
                                        <div class="flex ml-16">
                                            <span><button type="button" edit-id="{{ $comment->id }}" class="edit text-sm text-blue-500">Edit</button> </span>

                                            <span class="ml-2"><button type="button" class="delete text-sm text-red-500" delete-id="{{ $comment->id }}">Delete</button> </span>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach

                @else

                    @auth
                        <h1 class="text-center zero-comments">Oops, seems like this comment section is a wasteland! Why dont you populate it by saying something nice?</h1>
                    @endauth

                @endif

			</div>

        </div>

	</div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="comment" class="col-form-label">Comment:</label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="edit-button" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
            
            $(this).toggleClass("text-{{ $themeText }}-500");
            if($(this).hasClass("text-{{ $themeText }}-500"))
            {
                $('.down-vote').removeClass("text-{{ $themeText }}-500");
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
            $(this).toggleClass("text-{{ $themeTextHover }}-500");
            if($(this).hasClass("text-{{ $themeTextHover }}-500"))
            {
                $('.up-vote').removeClass("text-{{ $themeTextHover }}-500");
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

@auth
    <script>
        //add comment
        $('#form-comment').on('submit', function(e) {
            e.preventDefault();
            var comment = $('#comment-textarea').val();
            var postId = $("#post-id").val();
            var _token = '{{ Session::token() }}';
            
            if ('{{ Auth::user()->image }}') 
            {
                var img = '{{ asset('storage/'.Auth::user()->image) }}'
            }else 
            {
                var img = '{{ asset('/images/blank-profile.png') }}'
            }
            $.ajax({
                type: "POST",
                url: '{{ route('comment.create') }}',
                data: {comment:comment, postId:postId, _token:_token},
                success: function(msg) {
                    $('.zero-comments').empty();
                    $(".comment-section").prepend(msg.comment);
                }
            });
        });
        
    </script>
@endauth

<script>
    //remove comment
    $('.delete').on('click', function(e) {
        var commentId = $(this).attr('delete-id');
        e.preventDefault();
        var _token = '{{ Session::token() }}';
        $.ajax({
            type: "DELETE",
            url: '{{ route('comment.destroy') }}',
            data: {commentId:commentId, _token:_token},
            success: function(msg) {
                $("#" + commentId + "single-comment").remove();
            }
        });
    });
</script>

<script>
    //edit comment
    $('.edit').on('click', function(e) {
        var commentId = $(this).attr('edit-id');
        var commentVal = $('#' + commentId + 'comment-val').text();
        
        e.preventDefault();
        $('#comment').val(commentVal);
        $('#editModal').modal('show');
        var _token = '{{ Session::token() }}';
        
        $('#edit-button').on('click', function(e) {
            var newCommentVal = $('#comment').val();
            //console.log('edit', newCommentVal);
            $.ajax({
                type: "PUT",
                url: '{{ route('comment.update') }}',
                data: {commentId:commentId, _token:_token, newCommentVal:newCommentVal},
                success: function(msg) {
                    $('#editModal').modal('hide');
                    $('#' + commentId + 'comment-val').text(msg.updatedComment);
                }
            });
        });
    });
</script>

<script>
    
    function handleDelete(id)
    {
        console.log('deleting', id);    
    }

</script>
@endsection