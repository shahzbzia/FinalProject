<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HireMe\HireMeFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\HireMeMail;
use App\User;

class HireMeController extends Controller
{
    public function index($userName)
    {
    	$user = User::where('userName', $userName)->firstOrFail();

    	return view('hireMe')->with('user', $user);
    }

    public function sendHireMeEmail(HireMeFormRequest $request, $userName)
    {
    	//dd($request->all());

    	$user = User::where('userName', $userName)->firstOrFail();

    	$name = auth()->user()->userName;

    	$email = $request->email;

    	$subject = $request->subject;

    	$description = $request->description;

    	//dd($email, $subject, $description);

    	Mail::to($user->email)->send(new HireMeMail($name, $email, $subject, $description));

    	session()->flash('success', 'Request sent successfully!');

        return redirect()->route('user.profile', $userName);

    }
}
