<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use App\UserPostOrder;
use App\User;

class AdminController extends Controller
{
    // public function index()
    // {
    // 	return view('adminPanel');
    // }

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

   	public function allUsers()
   	{
   		$users = User::where('role_id', 1)->paginate(10);
   		$bannedUsers = User::onlyTrashed()->where('role_id', 1)->paginate(10);

   		return view('admin.allUsers')->with('users', $users)->with('bannedUsers', $bannedUsers);
   	}

   	public function banUser($userName)
   	{
   		$user = User::where('userName', $userName)->firstOrFail();

   		//Mail

   		$user->delete();

   		session()->flash('success', 'User banned successfully!');

        return redirect(route('users.all'));
   	}

   	public function unBanUser($userName)
   	{
   		$user = User::onlyTrashed()->where('userName', $userName)->firstOrFail();

   		//Mail

   		$user->restore();

   		session()->flash('success', 'User Un-banned successfully!');

        return redirect(route('users.all'));
   	}
}
