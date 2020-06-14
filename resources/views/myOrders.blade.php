@extends('layouts.app')

@section('content')

<div class="container">
  @foreach ($items as $item)
      @if ($item->post)
        @if ($item->post->deleted_at == null)
        <div class="w-full md:w-4/5 align-middle mx-auto mb-4" >
            <div class="max-w-sm w-full md:max-w-full lg:flex">


                @if ($item->post->deleted_at == null)
                    @if ($item->post->getMedia('images')->first())
                        <div class="h-48 lg:h-48 lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ $item->post->getMedia('images')->first()->getUrl('watermarked') }}')">
                        </div>
                    @endif

                     @if ($item->post->getMedia('video')->first())
                        <div class="sm:h-32 md:h-48 lg:h-auto lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                            <video controls controlsList="nodownload">
                                <source src="{{asset($item->post->getMedia('video')->first()->getUrl())}}" type="{{ $item->post->getMedia('video')->first()->mime_type }}">
                            </video>
                        </div>
                    @endif
                @endif

                {{-- {{ $item->post->id }} --}}

                
                    <a class="hover:no-underline" href="{{ route('post.show', $item->post->slug) }}">
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-3 flex flex-col justify-between leading-normal w-full min-h-64">
                            <div class="mb-3 ml-2">
                                <div class="text-gray-900 font-bold text-base mb-2">{{ $item->post->title }}</div>
                                <div>
                                    <p class="text-gray-700 text-sm mb-2"><strong>Invoice id:</strong> {{ $item->order->stripe_charge_id }} ({{ \Carbon\Carbon::parse($item->order->created_at)->format('d-m-Y') }})</p>
                                    <p class="text-gray-700 text-sm mb-2"><strong>Billing Name: </strong> {{ $item->order->billing_name_on_card }}</p>


                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="mr-4">
                                    <a href="{{ route('posts.downloadable', $item->post->download_id) }}" target="_blank" class="hover:no-underline hover:text-black">
                                        <button type="button" class="font-semibold">Download Media</button>
                                    </a>
                                </div>

                                <div>
                                    <a href="{{ route('issue.index', [$item->order->id, $item->post->id]) }}">
                                        <button class="font-semibold hover:no-underline" type="button">Open a dispute</button>
                                    </a>
                                </div>
                            </div>                        
                        </div>
                    </a>
            </div>
        </div>
        @endif
    @endif    
  @endforeach
  

</div>

@endsection