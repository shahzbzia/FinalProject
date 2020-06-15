@if (Auth::user()->checkRole() == 2)

    <aside class="w-1/5 mt-3 leading-none hidden md:block lg:block xl:block">
                    
        <section class="mb-8">
            <h5 class="uppercase mb-4 font-bold">Admin Dashboard</h5>

            <ul class="list-none">

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'users.all') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('users.all') }}">All Users</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'all.issues') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.issues') }}">Disputes / Issues</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'all.orders') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.orders') }}">Orders</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'all.charges') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.charges') }}">Charges</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'all.activities') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.activities') }}">Activities</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'all.posts') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.posts') }}">Posts</a>
                </li>

                <li class="text-sm pb-4">
                    <a class="@if (Route::currentRouteName() == 'themes.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('themes.index') }}">Manage themes</a>
                </li>

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

    <div class="leading-none block md:hidden lg:hidden xl:hidden">
                    
        <section class="mb-8">
            <h5 class="uppercase mb-4 font-bold">Admin Dashboard</h5>

            <ul class="list-none">

                <li class="text-sm p-3 border">
                    <a class="@if (Route::currentRouteName() == 'users.all') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('users.all') }}">All Users</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'all.issues') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.issues') }}">Disputes / Issues</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'all.orders') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.orders') }}">Orders</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'all.charges') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.charges') }}">Charges</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'all.activities') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.activities') }}">Activities</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'all.posts') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('all.posts') }}">Posts</a>
                </li>

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'themes.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('themes.index') }}">Manage themes</a>
                </li>

            </ul>


        </section>

        <section class="mb-8">
            
            <h5 class="uppercase mb-4 font-bold">Settings</h5>

            <ul class="list-none">

                <li class="border text-sm p-3">
                    <a class="@if (Route::currentRouteName() == 'user.showUserEditForm') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('user.showUserEditForm') }}">Edit Profile</a>
                </li>
            </ul>


        </section>

    </div>

    @else

    <aside class="w-1/5 mt-3 leading-none hidden md:block lg:block xl:block">
                    
    <section class="mb-8">
        <h5 class="uppercase mb-4 font-bold">Quick Links</h5>

        <ul class="list-none">
            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'createPost') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('createPost') }}">Create a Post</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'my.posts') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('my.posts', Auth::user()->userName) }}">My Posts</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'my.emptyPosts') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('my.emptyPosts', Auth::user()->userName) }}">Unfinished Posts</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'marketPlace.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('marketPlace.index') }}">Market Place</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'order.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('order.index') }}">My Orders</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'my.issues') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('my.issues') }}">My Disputes</a>
            </li>

        </ul>


    </section>

    <section class="mb-8">
        
        <h5 class="uppercase mb-4 font-bold">Settings</h5>

        <ul class="list-none">

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'user.showUserEditForm') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('user.showUserEditForm') }}">Edit Profile</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'card.update' || Route::currentRouteName() == 'card.create') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" 
                href="{{ (Auth::user()->recipientId) ? route('card.update') : route('card.create') }}">Add/Update <br> Bank Details</a>
            </li>

            <li class="text-sm pb-4">
                <a class="@if (Route::currentRouteName() == 'contactSupport.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="{{ route('contactSupport.index') }}">Contact Support</a>
            </li>

        </ul>


    </section>

</aside>

@endif

