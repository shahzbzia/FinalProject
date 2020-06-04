@extends('layouts.app')

@section('content')
<div class="container">
    

	<div class="mb-2 mt-3 border-solid border-gray-300 rounded border shadow-sm w-full ">
        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b flex justify-between">
            <div class="mx-2">
            	{{ (isset($theme)) ? 'Edit theme' : 'Create a theme' }}
            </div>
        </div>
        <div class="p-3">

            <form action="{{ isset($theme) ? route('themes.update', $theme->id) : route('themes.store') }}" method="POST">
                
                @csrf

                @if (isset($theme))
                    @method('PUT')
                @endif

                <div class="mb-4">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>

                    <input id="name" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') bg-red-200 @enderror" name="name" value="{{ (isset($theme)) ? $theme->name : '' }}" required autocomplete="value" autofocus required>

                    @error('name')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-4">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="value">
                        Value
                    </label>

                    <input id="value" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('value') bg-red-200 @enderror" name="value" value="{{ (isset($theme)) ? $theme->value : '' }}" required autocomplete="value" autofocus required>

                    @error('value')
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <button type="submit" class="px-3 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white">Save</button>

            </form>
            
        </div>
    
    </div>


@endsection