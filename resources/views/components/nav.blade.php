@guest
  <ul class="list-reset">
  <div class="flex justify-end">
    <li>
      <a href="{{ route('login') }}" class=" @if (Route::currentRouteName() == 'login') active @endif block mt-4 lg:inline-block lg:mt-0 text-black hover:underline hover:text-black mr-10 font-semibold">Login</a>
    </li>

    <li>
      <a href="{{ route('register') }}" class="@if (Route::currentRouteName() == 'register') active @endif block mt-4 lg:inline-block lg:mt-0 text-black hover:underline hover:text-black mr-10 font-semibold">Sign Up</a>
    </li>
  </div>
</ul>
@endguest

@auth
<nav class="flex items-center justify-between flex-wrap bg-{{Auth::user()->theme->value}}-500 shadow-xl">

  <div class="flex items-center flex-shrink-0 text-white mr-56 ml-6">

    <a class="font-bold text-2xl tracking-tight hover:no-underline hover:text-white" href="">Final Project <span class="text-sm">Real name TBA</span></a>

  </div>

  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">

    <ul class="list-reset align-middle my-4 font-semibold">

    <div class="flex">
      <li>
        <a href="" class="{{-- @if (Route::currentRouteName() == 'todos.index') active @endif --}} block lg:inline-block lg:mt-0 text-gray-100 hover:underline hover:text-white mr-4">Home</a>
      </li>

      <li>
        <a href="" class="{{-- @if (Route::currentRouteName() == 'todos.create') active @endif --}} block lg:inline-block lg:mt-0 text-gray-100 hover:underline hover:text-white mr-4">Create</a>
      </li>

      <li>
        <a href="" class="{{-- @if (Route::currentRouteName() == 'user.index') active @endif --}} block lg:inline-block lg:mt-0 text-gray-100 hover:underline hover:text-white mr-4">Profile</a>
      </li>

      {{-- <li>
        <a href="" class="block lg:inline-block lg:mt-0 text-gray-100 hover:underline hover:text-white mr-4">Diary</a>
      </li> --}}

      <li>

        <a class="block lg:inline-block lg:mt-0 text-gray-100 hover:underline hover:text-white mr-4" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
      </li>
    </div>

          
      </ul>

    </div>

  </div>

</nav>

@endauth