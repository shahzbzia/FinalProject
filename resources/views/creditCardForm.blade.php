@extends('layouts.app')

@section('content')
<div class="container">

    <div class="align-middle mx-auto mt-12 w-full lg:w-3/5 xl:w-3/5">

        <h2 class="text-2xl text-{{ Auth::user()->theme->value }}-500 font-bold tracking-widest uppercase font-mono mb-2 ml-4">{{ (isset($customer) ? 'Update banking details' : 'Add banking details') }}</h2>

        <form class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ (isset($customer) ? route('card.saveUpdate') : route('card.store')) }}" id="payment-form">

            @csrf

            @if(isset($customer))
                @method('PUT')
            @endif

            <h5 class="text-base font-bold">Customer Details</h5>

            <hr class="mt-2 mb-3">

            <div class="mb-4">

                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name_on_card">
                        Name
                    </label>

                    <button class="mb-2 text-{{ Auth::user()->theme->value }}-500" id="same-as-name" type="button">My name</button>
                </div>

                <input id="name_on_card" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name_on_card') bg-red-200 @enderror" name="name_on_card" value="{{ (isset($customer) ? $customer['name'] : old('name_on_card')) }}" required autocomplete="email" autofocus>

                @error('name_on_card')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="billing_email">
                        Email
                    </label>
                </div>

                <input id="billing_email" type="billing_email" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-300 leading-tight focus:outline-none focus:shadow-outline @error('billing_email') bg-red-200 @enderror" name="billing_email" value="{{ (isset($customer) ? $customer['email'] : $user->email) }}" required autocomplete="billing_email" autofocus readonly>

                @error('billing_email')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="billing_address">

                        Billing Address

                    </label>

                    <button class="mb-2 text-{{ Auth::user()->theme->value }}-500" id="same-as-address" type="button">Same as my address</button>
                </div>

                <textarea name="billing_address" rows="2" cols="50" id="billing_address" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('billing_address') bg-red-200 @enderror" > {{ (isset($customer) ? $customer['address']['line1'] : old('billing_address')) }} </textarea>

                @error('billing_address')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>


            <h5 class="text-base font-bold">Bank Details</h5>

            <hr class="mt-2 mb-3">

            <div class="mb-4">

                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="iban">
                        IBAN
                    </label>

                    <button class="mb-2 text-{{ Auth::user()->theme->value }}-500" id="demo-iban" type="button">Demo Iban</button>
                </div>

                <input id="iban" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('iban') bg-red-200 @enderror" name="iban" value="{{ (isset($customer) ? $customer['metadata']['iban'] : old('iban')) }}" required autocomplete="email" autofocus>

                @error('iban')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-4">

                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="bic">
                        BIC
                    </label>

                    <button class="mb-2 text-{{ Auth::user()->theme->value }}-500" id="demo-bic" type="button">Demo Bic</button>
                </div>

                <input id="bic" type="text" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bic') bg-red-200 @enderror" name="bic" value="{{ (isset($customer) ? $customer['metadata']['bic'] : old('bic')) }}" required autocomplete="email" autofocus>

                @error('bic')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            

            {{-- <div class="form-group">
                <label for="card-element" class="block text-gray-700 text-sm font-bold mb-2">
                    Credit or debit card
                </label>
                <div id="card-element" class="shadow-md appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    
                </div>

                <div id="card-errors" role="alert" class="text-red-600"></div>
            </div> --}}

            <button type="submit" class="w-full bg-{{ Auth::user()->theme->value }}-500 py-2 text-white font-semibold">{{ (isset($customer) ? 'update' : 'save') }}</button>

        </form>

    </div>

</div>


{{-- <script>
    // Create a Stripe client.
        var stripe = Stripe('pk_test_ZtSQc3dJIJ7Eai5mIP0UALBJ001pF62p0f');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
          base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();

          var options = {
            email: document.getElementById('billing_email').value,
            name: document.getElementById('name_on_card').value,
            address: document.getElementById('billing_address').text,
          }

          stripe.createToken(card, options).then(function(result) {
            if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-error s');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
            }
          });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);

          // Submit the form
          form.submit();
        }
</script> --}}

<script>

    var address = '{{ Auth::user()->address }}';
    var name = '{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}';
    
    $("#same-as-address").on("click", function(){
        $("#billing_address").val(address);
    });

    $("#same-as-name").on("click", function(){
        $("#name_on_card").val(name);
    });

    $("#demo-iban").on("click", function(){
        $("#iban").val("BE66373179568342");
    });

    $("#demo-bic").on("click", function(){
        $("#bic").val("BBREBUEB");
    });

</script>

@endsection