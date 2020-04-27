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

    <a class="font-bold text-2xl tracking-tight hover:no-underline hover:text-white my-3" href="{{ route('home') }}">ARTillary</a>

  </div>

  @php
    $pathImage = (Auth::user()->image) ? asset("storage/".Auth::user()->image) : asset('/images/blank-profile.png');

    if(App::environment('production')) {
      $pathImage = (Auth::user()->image) ? asset("storage/app/public/".Auth::user()->image) : asset('/public/images/blank-profile.png');
    }

    $pathArrow = (App::environment('production')) ? asset('/public/images/down_arrow.png') : asset('/images/down_arrow.png');

    $userProfession = (Auth::user()->profession) ? Auth::user()->profession : 'Artist';
  @endphp
  

  <div id="getWidth" class="flex justify-around mr-8">
    <img class="border-2" id="avatarImage" width="50" height="50" src="{{ $pathImage }}">
        
    <div class="ml-3 text-white font-semibold">
      <h5 class="text-base">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h5>
      <p class="text-xs text-left">{{ $userProfession }}</p>
    </div>

    <button class="ml-4 focus:outline-none">
      <img class="dropbtn" width="14" height="14" src="{{ $pathArrow }}" onclick="myFunction()">
    </button>
  </div>

  <div id="myDropdown" class=" text-base dropdown-content rounded-lg py-2">

    <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:bg-{{ Auth::user()->theme->value }}-500 hover:text-white hover:no-underline">Home</a>

    <a href="" class="{{-- @if (Route::currentRouteName() == 'user.index') active @endif --}} block px-4 py-2 text-gray-800 hover:bg-{{ Auth::user()->theme->value }}-500 hover:text-white hover:no-underline">Profile</a>

    <a class="block px-4 py-2 text-gray-800 hover:bg-{{ Auth::user()->theme->value }}-500 hover:text-white hover:no-underline" href="{{ route('logout') }}"
       onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>

  </div>

</nav>



<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}

</script>

<style>
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    margin-top: 212px;

  }

  .show {
    display: block;
  }
</style>

@endauth