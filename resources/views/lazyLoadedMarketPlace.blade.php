@php

    $themeTextHover = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-700' : 'text-black';

@endphp

@foreach ($posts as $post)
    <a href="{{ route('post.show', $post->slug) }}" class="">
        
        <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden my-3 align-middle @auth mx-3 @else mx-3 mx-auto lg:w-1/2 @endauth">
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
                
                
                @auth
                    
                    @if (App\Http\Controllers\MarketController::owned(Auth::user()->id, $post->id))

                        <button type="button" id="{{ $post->id.'add-to-cart-button' }}" class="hover:no-underline hover:text-{{ $themeTextHover }}-500 px-3 py-1 bg-black text-sm text-white font-semibold rounded" disabled>OWNED</button>

                    @else

                        @if (\Cart::session(Auth::user()->id)->has($post->id))
                    
                            <button type="button" id="{{ $post->id.'add-to-cart-button' }}" class="hover:no-underline hover:text-{{ $themeTextHover }}-500 px-3 py-1 bg-green-400 text-sm text-white font-semibold rounded" disabled>✔ Added to cart</button>

                        @elseif($post->user_id == Auth::user()->id)

                        <button type="button" id="{{ $post->id.'add-to-cart-button' }}" class="hover:no-underline hover:text-{{ $themeTextHover }}-500 px-3 py-1 bg-black text-sm text-white font-semibold rounded" disabled>Posted by you</button>

                        @else

                            <button type="button" id="{{ $post->id.'add-to-cart-button' }}" class="add-to-cart hover:no-underline hover:text-{{ $themeTextHover }}-500 px-3 py-1 bg-gray-200 text-sm text-gray-900 font-semibold rounded" post-id="{{ $post->id }}">Add to cart</button>

                        @endif

                    @endif

                @endauth


            </div>
        </div>

    </a>
@endforeach

<script>
    //add post to the cart
    $('.add-to-cart').on('click', function() {
        var postId = $(this).attr('post-id');
        //console.log(postId);
        var _token = '{{ Session::token() }}';
        $.ajax({
            type: "POST",
            url: '{{ route('cart.add') }}',
            data: {postId:postId, _token:_token},
            success: function(data) {
                if (data.success) 
                {
                    $('#' + postId + 'add-to-cart-button').text('✔ Added to cart');
                    $('#' + postId + 'add-to-cart-button').addClass('bg-green-400');
                    $('#' + postId + 'add-to-cart-button').addClass('text-white');
                    $('#' + postId + 'add-to-cart-button').attr('disabled', true);
                    $('.cart-total-products').text(data.numOfItems);

                }
            }
        });
    });
    
</script>