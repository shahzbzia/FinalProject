@extends('layouts.app')

@section('content')
<div class="container">

    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5">

        <div class="flex justify-between">
            <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">Contact Support</h2>

            <button id="support-quick-fill" type="button">DEMO QUICK FILL</button>
        </div>

        <form class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('contactSupport.sendContactSupportEmail') }}">

            @csrf

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>

                <input id="email" type="email" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-200 @enderror" name="email" value="@if($errors->any()) {{ old('email') }} @else {{ Auth::user()->email }} @endif" required autocomplete="email" autofocus>

                @error('email')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

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

                <label class="block text-gray-700 text-sm font-semibold mb-2" for="question">

                    Question

                </label>

                <textarea name="question" rows="2" cols="50" id="question" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('question') bg-red-200 @enderror" >{{ old('question') }} </textarea>

                @error('question')
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
    $("#support-quick-fill").on("click", function(){
        $("#subject").val("I have a small question");
        $("#question").val("Where can I read the terms and service or the community guide lines?")
    });
</script>
@endsection
