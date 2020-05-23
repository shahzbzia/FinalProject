<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use App\Post;
use Auth;

class CartController extends Controller
{
    public function index()
    {
    	$userId = Auth::user()->id;
    	$emptyMessage = null;

		if (\Cart::session($userId)->isEmpty()) {
			$emptyMessage = 'Your cart seems to be empty! Why dont you fill it up with something?';
		}

    	$items = \Cart::getContent();
    	$subTotal = \Cart::session($userId)->getSubTotal();
    	$total = \Cart::session($userId)->getTotal();
		return view('cartPage')
			->with('items', $items)
			->with('emptyMessage', $emptyMessage)
			->with('subTotal', $subTotal)
			->with('total', $total);
    }

    public function add(Request $request)
    {
    	$post = Post::find($request->postId);
		$rowId = $post->id;
		$userId = Auth::user()->id;

		// add the product to cart
		\Cart::session($userId)->add(array(
		    'id' => $rowId,
		    'name' => $post->title,
		    'price' => $post->royaltyFee,
		    'quantity' => 1,
		    'associatedModel' => $post
		));

		//session()->flash('success', 'Item added to cart sucessfully!');

		return response()->json([
			'success' => 'Item added to cart sucessfully!',
			'numOfItems' => \Cart::session($userId)->getContent()->count(),
		]);
        //return redirect(route('cart.index'));
	}

	public function remove($id)
    {
    	$post = Post::find($id);
		$rowId = $post->id;
		$userId = Auth::user()->id;

		// add the product to cart
		\Cart::session($userId)->remove($rowId);

		session()->flash('success', 'Item removed from cart sucessfully!');

        return redirect(route('cart.index'));
	}



}
