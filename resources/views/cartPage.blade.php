@extends('layouts.app')

@section('content')
    <div class="container mt-3">

        <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">Your cart</h2>

        <div class="bg-white shadow-xl rounded-lg px-6 pt-6 pb-8 mb-4">

            <div class="mt-2 mb-8">
                <h2 class="text-lg text-center font-semibold">Products</h2>
            </div>

            <div class="flex-col">
                @foreach ($items as $item)
                    

                <div class="flex justify-between">
                    <div class="flex mt-4">

                    <div>
                        @if ($item->associatedModel->getMedia('images')->first())
                            <img class="h-14 w-20" src="{{ $item->associatedModel->getMedia('images')->first()->getUrl('watermarked') }}">
                        @endif

                        @if ($item->associatedModel->getMedia('video')->first())
                            <video class="h-16 w-16" controls controlsList="nodownload">
                                <source src="{{asset($item->associatedModel->getMedia('video')->first()->getUrl())}}" type="{{ $item->associatedModel->getMedia('video')->first()->mime_type }}">
                            </video>
                        @endif
                    </div>

                    <div class="mt-2 ml-2">
                        <div>
                            <h3 class="font-semibold text-black">{{ $item->associatedModel->title }}</h3>
                            <p>
                                @if ($item->associatedModel->getMedia('images')->first())
                                    {{ $item->associatedModel->getMedia('images')->first()->mime_type }}
                                @endif

                                @if ($item->associatedModel->getMedia('video')->first())
                                    {{ $item->associatedModel->getMedia('video')->first()->mime_type }}
                                @endif
                            </p>
                        </div>
                    </div>

                </div>

                <div class="align-middle my-auto w-1/5">
                    <p class="italic text-center font-semibold">${{ $item->associatedModel->royaltyFee }}</p>
                </div>

                <div class="align-middle my-auto">
                    <a href="{{ route('cart.remove', $item->associatedModel->id) }}"><p>Remove</p></a>
                </div>
            </div>
                    

                @endforeach

                @if (null !== $emptyMessage)
                    <h3 class="text-center align-middle mx-auto">{{ $emptyMessage }}</h3>
                @endif
            </div>
            
        </div>

        <div id="posts" class="profile-tab-content mb-8">
            <div class="max-w-md mx-auto xl:max-w-full lg:max-w-full md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative">
                <div class="p-3 bg-gray-900 text-gray-900 rounded-t">
                    <h5 class="text-white text-sm text-center">Order Summary</h5>
                </div>
                <div class="p-3 w-full h-full overflow-y-auto flex justify-between">
                    <p>
                        Subtotal
                    </p>

                    <p>
                        ${{ $subTotal }}
                    </p>
                </div>

                <hr>

                <div class="p-3 w-full h-full overflow-y-auto flex justify-between">
                    <p>
                        Shipping
                    </p>

                    <p>
                        ----
                    </p>
                </div>

                <hr>

                <div class="p-3 w-full h-full overflow-y-auto flex justify-between bg-gray-300">
                    <p class="font-semibold">
                        Total
                    </p>

                    <p class="font-semibold">
                        ${{ $total }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center">
            <a class="uppercase py-3 px-10 text-center text-white font-semibold bg-{{ Auth::user()->theme->value }}-500" href="">Checkout</a>
        </div>
        
    </div>
@endsection