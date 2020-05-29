<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\Checkout\CheckoutFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationBuyer;
use App\Mail\OrderConfirmationSeller;
use Auth;
use App\Order;
use App\UserPostOrder;
use Storage;

class CheckoutController extends Controller
{

    public function index()
    {
    	return view('checkOut');
    }

    public function store(CheckoutFormRequest $request)
    {
    	$user = Auth::user();
    	$userId = $user->id;
    	//$buyerEmail = $user->email;
    	$cartTotal = \Cart::session($userId)->getTotal();
    	//dd($request->all(), $cartTotal);

    	$contents = \Cart::session($userId)->getContent()->map(function ($item) {
            return $item->model->title.', ';
        })->values()->toJson();

        try {
        	$newStripe = Stripe::make('sk_test_rhSHXuAwqoAgZldNpSQpAH9X00DVM6dfVO');
            $charge = $newStripe->charges()->create([
            	'receipt_email' => $request->billing_email,
                'amount' => $cartTotal,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'metadata' => [
                    'contents' => $contents,
                ],
            ]);

            $chargeId = $charge['id'];

            $order = $this->createOrder($request, $chargeId, $cartTotal, $userId);

            Mail::to($request->billing_email)->send(new OrderConfirmationBuyer($chargeId, $contents));

            // Mail::send(new OrderPlaced($order));

            foreach (\Cart::session($userId)->getContent() as $item) {
	            Storage::put('attempt1' .$item->model->user_id. '.txt', $item->model->user->userName);
	        }

            \Cart::session($userId)->clear();

            session()->flash('success', 'Thank you! Your payment was successfull.');

            return redirect()->route('order.index');

        } catch (CardErrorException $e) {
            // $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function createOrder($request, $chargeId, $cartTotal, $userId)
    {
        $order = Order::create([
            'user_id' => $userId,
            'billing_email' => $request->billing_email,
            'billing_address' => $request->billing_address,
            'billing_name_on_card' => $request->name_on_card,
            'billing_total' => $cartTotal,
            'stripe_charge_id' => $chargeId,
        ]);

        // Insert into post_user table
        foreach (\Cart::session($userId)->getContent() as $item) {
            UserPostOrder::create([
                'user_id' => $userId,
                'post_id' => $item->model->id,
                'order_id' => $order->id,
            ]);
        }

        return $order;
    }
}
