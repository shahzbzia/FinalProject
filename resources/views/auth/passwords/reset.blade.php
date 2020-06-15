@extends('layouts.app')

@section('content')
<div class="container">
    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5">
        <h2 class="text-2xl text-black font-bold tracking-widest uppercase font-mono mb-2 ml-4">Reset Password</h2>
                       
            <form method="POST" class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email  <span class="text-red-500">*</span> 
                    </label>

                    <input id="email" type="email" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-200 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="example@gmail.com" autofocus>

                    @error('email')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="flex flex-col md:flex-row lg:flex-row xl:flex-row justify-between">
                <div class="mb-4 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input id="password" type="password" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-200 @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" placeholder="minimum 8 letters" autofocus>

                    @error('password')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-6 w-full md:w-2/5 lg:w-2/5 xl:w-2/5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password-confirm">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>

                    <input id="password-confirm" type="password" class="shadow-md appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password-confirm ') bg-red-200 @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="minimum 8 letters">

                    @error('password')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

                <button class="hover:bg-gray-700 bg-black hover:text-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Reset Password
                </button>
            </form>         
        
    </div>
</div>
@endsection
