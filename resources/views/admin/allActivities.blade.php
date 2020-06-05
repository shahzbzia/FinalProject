@extends('layouts.app')

@section('content')
<div class="container">

	<table class="table-auto">
	  <thead>
	    <tr>
	      <th class="px-4 py-2">User ID (User name)</th>
	      <th class="px-4 py-2">Post ID (Title)</th>
	      <th class="px-4 py-2">Order ID (Charge/Invoice ID)</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach ($activites as $activity)
	    <tr class="bg-gray-100">
	      <div>
	      	<td class="border px-4 py-2 text-center">{{ $activity->user_id }} <p>({{ $activity->user->userName }})</p></td></div>
	      <div><td class="border px-4 py-2 text-center">{{ $activity->post_id }}</td></div>
	      <td class="border px-4 py-2 text-center">{{ $activity->order_id }} <p>({{ $activity->order->stripe_charge_id }})</p></td>
	    </tr>
	    @endforeach
	  </tbody>
	</table>

</div>
@endsection