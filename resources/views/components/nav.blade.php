@php
    $themeText = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-500' : 'text-gray-800';

    $themeTextHover = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-700' : 'text-black';

    $themeBg = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-500' : 'bg-black';

    $themeBgHover = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-700' : 'bg-black';

@endphp

<nav class="flex items-center justify-between flex-wrap {{ $themeBg }} shadow-xl">
  
  @auth
  <div class="flex items-center flex-shrink-0 text-white ml-3 w-3/12 md:w-2/12 lg:w-1/2">

    <a class="font-bold tracking-tight hover:no-underline hover:text-white lg:w-2/12 lg:mr-72" href="{{ route('home') }}">
      <img src="/images/artillary-logo-gif.gif" alt="Artillary Logo">
    </a>

  </div>

  
    <div class="">
      <div class="flex items-center border-b border-b-2 border-white py-2"> 
        <input class="searchInput bg-transparent border-none w-full md:w-11/12 lg:w-11/12 xl:w-11/12 text-white mr-3 py-1 px-2 leading-tight focus:outline-none placeholder-white text-xs" name="nameSearch" id="nameSearch" type="text" placeholder="Search Artists by Name">
      </div>
      <div id="nameList" class="dropdown-nameSearch text-base rounded-lg py-2"></div>
      @csrf
    </div>

  
    @php
      $pathImage = (Auth::user()->image) ? asset("storage/".Auth::user()->image) : asset('/images/blank-profile.png');

      if(App::environment('production')) {
        $pathImage = (Auth::user()->image) ? asset("storage/app/public/".Auth::user()->image) : asset('/public/images/blank-profile.png');
      }

      $pathArrow = (App::environment('production')) ? asset('/public/images/down_arrow.png') : asset('/images/down_arrow.png');

      $userProfession = (Auth::user()->profession) ? Auth::user()->profession : 'Artist';
    @endphp

    <div class="flex">

      <div class="align-middle my-auto hidden md:block">
        <a class="hover:no-underline" href="">
          <p class="uppercase font-semibold text-white border border-white p-2 px-4">

            AMMO

          <div class="flex flex-row-reverse w-full">
              <div slot="icon" class="relative">
                  <div class="absolute text-xs rounded-full -mt-10 ml px-1 font-bold top-0 right-0 text-white">{{ Auth::user()->ammo }}</div>
              </div>
          </div>

        </p></a>
      </div>

      <div class="align-middle my-auto mx-6 hidden md:block">
        <a class="hover:no-underline" href="{{ route('cart.index') }}">
          <p class="uppercase font-semibold text-white border border-white p-2 px-4">

          Cart

          <div class="flex flex-row-reverse w-full">
              <div slot="icon" class="relative">
                  <div class="cart-total-products absolute text-xs rounded-full -mt-10 ml px-1 font-bold top-0 right-0 text-white">{{ \Cart::session(Auth::user()->id)->getContent()->count() }}</div>  
              </div>
          </div>

        </p></a>
      </div>
      
      <div>
        <div id="getWidth" class="flex justify-around mr-6">
          <img class="border-2 rounded-full md:rounded-none lg:rounded-none xl:rounded-none mobile" id="avatarImage" onclick="myFunction()" width="50" height="50" src="{{ $pathImage }}">
              
          <div class="ml-3 text-white font-semibold hidden md:block lg:block xl:block">
            <h5 class="text-base">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h5>
            @if (Auth::user()->checkRole() == 2)
              <p class="uppercase text-xs text-left font-semibold">Admin</p>
            @else
              <p class="text-xs text-left">{{ $userProfession }}</p>
            @endif
            
          </div>

          <button class="ml-4 focus:outline-none hidden md:block lg:block xl:block">
            <img class="dropbtn" width="14" height="14" src="{{ $pathArrow }}" onclick="myFunction()">
          </button>
        </div>

        <div id="myDropdown" class=" text-base dropdown-content rounded-lg py-2">

          <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline">Home</a>

          <a href="{{ route('user.profile', Auth::user()->userName) }}" class="{{-- @if (Route::currentRouteName() == 'user.index') active @endif --}} block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline">Profile</a>

          <div class="block md:hidden lg:hidden xl:hidden px-4 py-2 font-semibold">
            <h5>Quick Links</h5>
            <hr>
          </div>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('createPost') }}">Create a post</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('my.posts', Auth::user()->userName) }}">My Posts</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('my.emptyPosts', Auth::user()->userName) }}">Unfinished Posts</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('marketPlace.index') }}">Market Place</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('order.index') }}">My Orders</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('my.issues') }}">My Disputes</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('cart.index') }}"><p>

          Cart

          <div class="flex flex-row w-full">
              <div slot="icon" class="relative">
                  <div class="cart-total-products absolute text-xs rounded-full -mt-8 ml-8 font-bold top-0 text-black">{{ \Cart::session(Auth::user()->id)->getContent()->count() }}</div>  
              </div>
          </div>

          </p></a>

          <div class="block md:hidden lg:hidden xl:hidden px-4 py-2 font-semibold">
            <h5>Settings</h5>
            <hr>
          </div>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('user.showUserEditForm') }}">Edit Profile</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ (Auth::user()->recipientId) ? route('card.update') : route('card.create') }}">Add/Update <br> Bank Details</a>

          {{-- <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="">Buy Ammo <br> <span class="text-xs font-thin">(Experimental)</span></a> --}}

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline md:hidden lg:hidden xl:hidden" href="{{ route('contactSupport.index') }}">Contact Support</a>

          <a class="block px-4 py-2 text-gray-800 hover:{{ $themeBgHover }} hover:text-white hover:no-underline" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
          </form>

        </div>
    </div>

    @else
    <div class="flex justify-between items-center text-white ml-3 py-2">

      <a class="font-bold w-3/12 md:w-1/6 lg:w-1/12 tracking-tight hover:no-underline hover:text-white lg:mr-192" href="{{ route('home') }}">
        <img src="/images/artillary-logo-gif.gif" alt="Artillary Logo">
      </a>

    
      <ul class="list-reset">
        <div class="flex justify-end">
          <li>
            <a href="{{ route('marketPlace.index') }}" class=" @if (Route::currentRouteName() == 'marketPlace.index') active @endif hidden md:block mt-1 lg:inline-block lg:mt-0 text-white hover:underline hover:text-white mr-10 font-semibold">Market Place</a>
          </li>

          <li>
            <a href="{{ route('login') }}" class=" @if (Route::currentRouteName() == 'login') active @endif block mt-1 lg:inline-block text-white hover:underline hover:text-white mr-10 font-semibold">Login</a>
          </li>

          <li>
            <a href="{{ route('register') }}" class="@if (Route::currentRouteName() == 'register') active @endif block mt-1 lg:inline-block text-white hover:underline hover:text-white mr-3 font-semibold">Join the ARTillary</a>
          </li>
        </div>
      </ul>

      </div>

    @endauth


  </div>

</nav>

@auth

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

  $(document).ready(function(){

    $('#nameSearch').keyup(function(){
      console.log('keyup');
      var query = $(this).val();
      if(query != '')
      {
        var _token = $('input[name="_token"]').val();
      }
      $.ajax({
        url:"{{ route('nameSearch') }}",
        method: "POST",
        data: {query:query, _token:_token},
        success:function(data){
          $('#nameList').fadeIn();
          $('#nameList').html(data);
          $(document).on('click', function(e) {
            if ( ! $(e.target).closest('#nameList').length ) {
              $('#nameList').hide();
            }
          })
        }
      })

    });

  });

  </script>

@endauth
