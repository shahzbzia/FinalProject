<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Post;
use Auth;
use App\Http\Requests\Issue\CreateIssueRequest;
use App\Issue;
use App\Mail\IssueRecieved;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class IssueController extends Controller
{
    public function index($orderId, $postId)
    {
    	$order = Order::whereId($orderId)->firstOrFail();
    	$post = Post::whereId($postId)->first();
    	//dd($post);
    	return view('createIssue')->with('order', $order)->with('post', $post);
    }

    public function myIssues()
    {
    	$user = Auth::user();

    	$issues = Issue::where('user_id', $user->id)->paginate(10);

    	return view('myIssues')->with('issues', $issues);
    }

    public function allIssues()
    {

    	$issuesNotResolved = Issue::whereNull('resolved_at')->paginate(10);
    	$issuesResolved = Issue::whereNotNull('resolved_at')->paginate(10);
    	//$issues = Issue::all();

    	return view('admin.issues.allIssues')->with('issuesNotResolved', $issuesNotResolved)->with('issuesResolved', $issuesResolved);
    }

    public function issueDetails($id)
    {

    	$issue = Issue::whereId($id)->firstOrFail();

    	return view('admin.issues.IssueDetails')->with('issue', $issue);
    }

    public function createIssue(CreateIssueRequest $request)
    {
    	$user = Auth::user();

    	$order = Order::whereId($request->order_id)->where('stripe_charge_id', $request->charge_id)->first();

    	$post = Post::whereId($request->postId)->firstOrFail();

    	//dd($post->user_id);

    	if ($order) {

    		$issue = Issue::create([
	    		'user_id' => $user->id,
	    		'post_id' => $post->id,
	    		'post_slug' => $post->slug,
	    		'post_price' => $post->royaltyFee,
	    		'poster_id' => $post->user_id,
	    		'subject' => $request->subject,
	    		'order_id' => $request->order_id,
	    		'charge_id' => $request->charge_id,
	    		'description' => $request->description,
	    	]);

	    	$order->update([
	    		'issue_created_at' => $issue->created_at,
	    	]);

	    	$issueId = $issue->id;
	    	$name = $user->userName;

	    	//Mail
    		Mail::to($user->email)->send(new IssueRecieved($issueId, $name));


    		session()->flash('success', 'Dispute submitted successfully!');

        	return redirect(route('my.issues'));

    	}

    	session()->flash('fail', 'The order Id or the Charge Id that you have provided is incorrect! Please provide us with the correct details.');

        return redirect()->back()->withInput();

    }

    public function resolved($id)
    {

    	$issue = Issue::whereId($id)->firstOrFail();
    	$issue->update([
    		'resolved_at' => Carbon::now(),
    	]);

    	session()->flash('success', 'Issue was marked as reloved successfully');

        return redirect(route('all.issues'));
    }

    public function unresolved($id)
    {

    	$issue = Issue::whereId($id)->firstOrFail();
    	$issue->update([
    		'resolved_at' => null,
    	]);

    	session()->flash('success', 'Issue was marked as un-reloved successfully');

        return redirect(route('all.issues'));
    }
}
