<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use App\Order;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Exception\NotFoundException;

class SearchController extends Controller
{
    public function adminSearch(Request $request)
    {
    	$query = $request->get('query');

    	$stripe = new Stripe('sk_test_rhSHXuAwqoAgZldNpSQpAH9X00DVM6dfVO');

    	try {
		    $charge = $stripe->charges()->find($query);

		} catch (NotFoundException $e) {
		
		    $charge = '"'. $query . '" matches none of the charges in our record.';
		}

    	$issues = Issue::where('user_id', 'like', "%$query%")
    		 ->orWhere('order_id', 'like', "%$query%")
    		 ->orWhere('charge_id', 'like', "%$query%")
    		 ->orWhere('post_id', 'like', "%$query%")
    		 ->paginate(5);

    	$orders = Order::where('user_id', 'like', "%$query%")
    		 ->orWhere('stripe_charge_id', 'like', "%$query%")
    		 ->paginate(5);


    	return view('admin.searchResults')->with('issues', $issues)->with('charge', $charge)->with('orders', $orders);
    }
}
