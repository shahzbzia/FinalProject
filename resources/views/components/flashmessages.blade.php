@if ($errors->any())
    <div role="alert" class="bg-red-300 text-white p-4 mt-8 font-bold rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-800">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div role="alert" class="bg-green-300 text-white p-4 mt-8 font-bold rounded">
        <p class="text-green-800">{{session()->get('success')}}</p>
    </div>
@endif

@if(session()->has('fail'))
    <div role="alert" class="bg-red-300 text-white p-4 mt-8 font-bold rounded">
        <p class="text-red-800">{{session()->get('fail')}}</p>
    </div>
@endif