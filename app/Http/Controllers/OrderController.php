<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPostOrder;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
    	$userId = auth()->user()->id;
    	$items = UserPostOrder::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
    	return view('myOrders')->with('items', $items);
    }

    public function allOrders()
    {
    	$orders = Order::paginate(10);

    	return view('admin.allSearchOrders')->with('orders', $orders);
    }
}
