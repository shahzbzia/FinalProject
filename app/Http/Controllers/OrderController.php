<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPostOrder;

class OrderController extends Controller
{
    public function index()
    {
    	$userId = auth()->user()->id;
    	$items = UserPostOrder::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
    	return view('myOrders')->with('items', $items);
    }
}
