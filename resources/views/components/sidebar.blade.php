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
                    <a class="text-black hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="">Manage shop <br> <span class="text-xs font-light">(Coming Soon)</span></a>
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
                    <a class="@if (Route::currentRouteName() == 'themes.index') text-{{Auth::user()->theme->value}}-500 font-bold @else text-black @endif hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" href="">Manage shop <br> <span class="text-xs font-light">(Coming Soon)</span></a>
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
                <a class="hover:no-underline hover:text-{{Auth::user()->theme->value}}-500" 
                href="#" onclick="buyAmmo()">Buy Ammo <br> <span class="text-xs font-thin">(Experimental)</span></a>
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

<div class="modal fade" id="buyAmmoModal" tabindex="-1" role="dialog" aria-labelledby="buyAmmoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('buy.ammo', Auth::user()->id) }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="buyAmmoModalLabel">Buy Ammo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form>
                <div class="form-group">
                    <label for="ammo" class="col-form-label">Ammount of ARTillary credits you want to buy?</label>
                    <input type="number" class="form-control" id="ammo" name="ammo" required>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Buy</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
    function buyAmmo()
    {
        //console.log('deleting', id);
        $('#buyAmmoModal').modal('show');
    }
</script>

@endif

