<form action="{{ route('admin.search') }}" method="GET" class="flex justify-center mt-2">
		
	<input id="query" type="text" class="mb-4 w-full md:w-3/4 lg:w-4/5 shadow-md border rounded py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('query') bg-red-200 @enderror" name="query" value="{{ request()->get('query') }}" placeholder="Search" required autocomplete="query" autofocus>

    <div>
    	<button type="submit" class="mt-1 ml-2 px-2 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white">Search</button>
    </div>

</form>