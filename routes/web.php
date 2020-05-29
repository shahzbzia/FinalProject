<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Post;
use App\Mail\HireMeMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/email', function (){
// 	return new HireMeMail();
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/user/{userName}', 'UserController@profile')->name('user.profile');

Route::post('/search/name', 'UserController@nameList')->name('nameSearch');
Route::get('/search/user/{query}', 'UserController@nameListAllResults')->name('nameListAllResults');

Route::get('/marketplace', 'MarketController@index')->name('marketPlace.index');

Route::get('/{slug}', 'PostController@show')->name('post.show');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/edit/profile', 'UserController@showUserEditForm')->name('user.showUserEditForm');
	Route::put('/edit/profile/update/{id}', 'UserController@update')->name('user.update');


	Route::get('/create/post', 'HomeController@createPost')->name('createPost');
	Route::post('/post/image/create', 'PostController@imagePost')->name('image.createPost');
	Route::post('/post/video/create', 'PostController@videoPost')->name('video.createPost');
	Route::get('/post/checkSlug', 'PostController@checkSlug')->name('posts.checkSlug');
	Route::get('/post/download/{download_id}', 'PostController@downloadable')->name('posts.downloadable');

	Route::get('/edit/post/{id}', 'PostController@edit')->name('editPost');
	Route::put('/edit/post/{id}/update', 'PostController@update')->name('updatePost');



	Route::post('/post/upVote', 'PostController@upVotePost')->name('upVotePost');
	Route::post('/post/downVote', 'PostController@downVotePost')->name('downVotePost');


	Route::post('/post/video/upload', 'PostController@uploadVideo')->name('uploadVideo');
	Route::delete('/post/video/delete/{id}', 'PostController@deleteUploadedVideo')->name('deleteUploadedVideo');


	Route::post('toggle/follow', 'UserController@toggleFollow')->name('toggleFollow');


	Route::post('post/comment/add', 'CommentController@create')->name('comment.create');
	Route::delete('post/comment/delete', 'CommentController@destroy')->name('comment.destroy');
	Route::put('post/comment/update', 'CommentController@update')->name('comment.update');


	Route::get('/my/cart', 'CartController@index')->name('cart.index');
	Route::post('/my/cart/add', 'CartController@add')->name('cart.add');
	Route::get('/my/cart/{id}/remove', 'CartController@remove')->name('cart.remove');


	Route::get('/my/cart/checkout', 'CheckoutController@index')->name('checkout.index');
	Route::post('/my/cart/checkout/charge', 'CheckoutController@store')->name('checkout.store');


	Route::get('/my/orders', 'OrderController@index')->name('order.index');


	Route::get('/hire/{userName}', 'HireMeController@index')->name('hireMe.index');
	Route::post('/hire/{userName}/send/mail', 'HireMeController@sendHireMeEmail')->name('hireMe.sendHireMeEmail');





	// Route::get('make/users', function () {
	//     $users = factory(App\User::class, 3)->make();
	//     return $users;
	// });

});