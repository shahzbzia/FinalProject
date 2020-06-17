@extends('layouts.app')

@section('content')
<div class="container">

    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5">

        <div class="flex justify-between">
            <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">Open a dispute</h2>

            <button id="issue-quick-fill" type="button">DEMO QUICK FILL</button>
        </div>

        <form class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('issue.create', $order->id) }}">

            @csrf

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">
                    Subject
                </label>

                <input id="subject" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('subject') bg-red-200 @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                @error('subject')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="order_id">
                    Order Id
                </label>

                <input id="order_id" type="text" class="bg-gray-200 shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('order_id') bg-red-200 @enderror" name="order_id" value="{{ $order->id }}" required autocomplete="order_id" autofocus readonly>

                @error('order_id')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <input type="hidden" name="postId" value="{{ $post->id }}">

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="charge_id">
                    Charge Id
                </label>

                <input id="charge_id" type="text" class="bg-gray-200 shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('charge_id') bg-red-200 @enderror" name="charge_id" value="{{ $order->stripe_charge_id }}" required autocomplete="charge_id" autofocus readonly>

                @error('charge_id')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-semibold mb-2" for="description">

                    Description of the problem

                </label>

                <textarea name="description" rows="2" cols="50" id="description" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') bg-red-200 @enderror" required>{{ old('description') }}</textarea>

                @error('description')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="flex items-center justify-between">

                <button class="hover:bg-{{ Auth::user()->theme->value }}-700 bg-{{ Auth::user()->theme->value }}-500 text-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    $("#issue-quick-fill").on("click", function(){
        $("#subject").val("Download files corrupt");
        $("#description").val("I bought this product and I am having a bit trouble downloading it. Actually the files download OK, but I cant open them. Its almost as if the files are corrupted.")
    });
</script>
@endsection
