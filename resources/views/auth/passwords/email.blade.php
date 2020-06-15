@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5">
        <h2 class="text-2xl text-black font-bold tracking-widest uppercase font-mono mb-2 ml-4">Reset Password</h2>

        <form method="POST" class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" action="{{ route('password.email') }}">
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

            <button class="hover:bg-gray-700 bg-black hover:text-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Send Password Reset Link
            </button>

        </form>

    </div>
</div>
@endsection
