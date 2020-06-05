<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use App\UserPostOrder;

class AdminController extends Controller
{
    public function index()
    {
    	return view('adminPanel');
    }

   	public function allCharges()
   	{
    	$stripe = new Stripe('sk_test_rhSHXuAwqoAgZldNpSQpAH9X00DVM6dfVO');

   		$charges = $stripe->charges()->all();

   		return view('admin.allCharges')->with('charges', $charges);
   	}

   	public function allActivities()
   	{
   		$activites = UserPostOrder::paginate(5);

   		return view('admin.allActivities')->with('activites', $activites);
   	}
}
