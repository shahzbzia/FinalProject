<aside class="w-1/5 mt-3 leading-none hidden md:block lg:block xl:block">
                        
    <section class="mb-8">
        <h5 class="uppercase mb-4 font-bold">Quick Links</h5>

        <ul class="list-none">
            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'createPost') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('createPost') }}">Create a Post</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'marketPlace.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('marketPlace.index') }}">Market Place</a>
            </li>

            
            {{--             <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'todos.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('todos.index') }}" href="">Long Term Assignments (coming Soon)</a>
            </li> --}}

        </ul>


    </section>

    <section class="mb-8">
        
        <h5 class="uppercase mb-4 font-bold">Settings</h5>

        <ul class="list-none">

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'user.showUserEditForm') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('user.showUserEditForm') }}">Edit Profile</a>
            </li>
        </ul>


    </section>

</aside>