@extends('layouts.app')

@section('content')
<div class="container">
    

	<div class="mb-2 mt-3 border-solid border-gray-300 rounded border shadow-lg w-full ">
        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b flex justify-between">
            <div class="mx-2">
            	Themes
            </div>

            <div class="mx-2">
            	<a href="{{ route('themes.create') }}" class="px-3 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white">Create</a>
            </div>
        </div>
        <div class="p-3">

        	
        		<table class="table-fixed">
				  <thead>
				    <tr>
				      <th class="w-1/2 px-4 py-2">Name</th>
				      <th class="w-1/2 px-4 py-2">Value</th>
				      <th class="w-1/2 px-4 py-2 text-center">Edit</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($themes as $theme)
				    <tr class="bg-gray-100">
				      <td class="px-4 py-2">{{ $theme->name }} <p class="bg-{{ $theme->value }}-500 p-1"></p></td>
				      <td class="px-4 py-2">{{ $theme->value }}</td>
				      <td class="flex">
				      	<a href="{{ route('themes.edit', $theme->id) }}" class="px-3 py-1 text-blue-600 font-semibold border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-black hover:no-underline hover:text-white mx-2">Edit</a>
				      </td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
        	
            
        </div>
    
    </div>


@endsection