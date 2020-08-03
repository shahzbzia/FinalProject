@extends('layouts.app')

@section('content')
<div class="container">

    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5"> 

        <div class="flex justify-between">
            <h2 class="text-2xl text-black font-bold tracking-widest uppercase font-mono mb-2 ml-4">Login</h2>

            <p>FILL IN DEMO CREDENTIALS <button type="button" class="text-red-600 font-semibold" id="login-admin-demo-button"> ADMIN </button> / <button type="button" id="login-user-demo-button" class="text-green-400 font-semibold"> USER </button></p>

        </div>

        <form class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">

            @csrf

            <div class="mb-4">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>

                <input id="email" type="email" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-200 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>

                <input id="password" type="password" class="shadow-md appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-200 @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password">

                @error('password')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="flex items-center justify-between">

                <button class="hover:bg-gray-700 bg-black hover:text-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Login
                </button>

                @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-black hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

            </div>

        </form>

    </div>

</div>

<script>

    $("#login-admin-demo-button").on("click", function(){
        $("#email").val("shahzebzia2000@hotmail.com");
        $("#password").val("test1234");
    });

    $("#login-user-demo-button").on("click", function(){
        $("#email").val("Johndoe15636@hotmail.com");
        $("#password").val("test1234");
    });

</script>
@endsection
