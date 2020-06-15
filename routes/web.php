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
    return redirect(route('home'));
});

// Route::get('/email', function (){
// 	return new HireMeMail();
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/user/{userName}', 'UserController@profile')->name('user.profile');
Route::get('/followers/of/{userName}', 'UserController@followers')->name('user.followers');
Route::get('/followed/by/{userName}', 'UserController@followings')->name('user.followings');

Route::post('/search/name', 'UserController@nameList')->name('nameSearch');
Route::get('/search/user/{query}', 'UserController@nameListAllResults')->name('nameListAllResults');

Route::get('/marketplace', 'MarketController@index')->name('marketPlace.index');

Route::get('/{slug}', 'PostController@show')->name('post.show');

Route::get('/posts/by/{userName}', 'UserController@myPosts')->name('my.posts');
Route::get('/empty/posts/by/{userName}', 'UserController@myEmptyPosts')->name('my.emptyPosts');


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

	Route::delete('/{id}/force/delete', 'PostController@destroy')->name('deletePost');

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
	Route::get('/my/disputes', 'IssueController@myIssues')->name('my.issues');
	Route::get('/open/dispute/{orderId}/{postId}', 'IssueController@index')->name('issue.index');
	Route::post('/open/dispute/{id}/submit', 'IssueController@createIssue')->name('issue.create');


	Route::get('/hire/{userName}', 'HireMeController@index')->name('hireMe.index');
	Route::post('/hire/{userName}/send/mail', 'HireMeController@sendHireMeEmail')->name('hireMe.sendHireMeEmail');
	Route::get('/contact/support', 'UserController@contactSupportIndex')->name('contactSupport.index');
	Route::post('/contact/support/send/mail', 'UserController@contactSupport')->name('contactSupport.sendContactSupportEmail');

	//Route::get('/test/test', 'UserController@checkStripeCustomerId')->name('testCustomerId');

	Route::get('/add/bank/details', 'UserController@createCardPage')->name('card.create');
	Route::post('/add/bank/details/save', 'UserController@storeCard')->name('card.store');
	Route::get('/update/bank/details', 'UserController@updateCardPage')->name('card.update');
	Route::put('/update/bank/details/save', 'UserController@updateCard')->name('card.saveUpdate');


	// Route::get('make/users', function () {
	//     $users = factory(App\User::class, 3)->make();
	//     return $users;
	// });

});


Route::group(['prefix' => 'admin' , 'middleware' => ['auth' => 'admin']], function(){

	Route::get('/dashboard', 'AdminController@index')->name('admin.index');
	Route::resource('themes', 'ThemesController');

	Route::get('/all/disputes', 'IssueController@allIssues')->name('all.issues');
	Route::get('/disputes/{id}', 'IssueController@issueDetails')->name('issue.details');
	Route::get('/disputes/{id}/resolved', 'IssueController@resolved')->name('issue.resolved');
	Route::get('/disputes/{id}/unresolved', 'IssueController@unresolved')->name('issue.unresolved');

	Route::get('/all/orders', 'OrderController@allOrders')->name('all.orders');
	Route::get('/all/posts', 'PostController@allPosts')->name('all.posts');
	Route::get('/delete/post/{id}', 'PostController@deleteByAdmin')->name('post.deleteByAdmin');

	Route::get('/all/charges', 'AdminController@allCharges')->name('all.charges');

	Route::get('/all/activities', 'AdminController@allActivities')->name('all.activities');

	Route::get('/all/users', 'AdminController@allUsers')->name('users.all');
	Route::get('/user/{userName}/ban', 'AdminController@banUser')->name('users.ban');
	Route::get('/user/{userName}/unban', 'AdminController@unBanUser')->name('users.unban');

	Route::get('/search', 'SearchController@adminSearch')->name('admin.search');
	Route::get('/search/all/issues/{query}', 'SearchController@seeAllSearchIssues')->name('search.allIssues');
	Route::get('/search/all/orders/{query}', 'SearchController@seeAllSearchOrders')->name('search.allOrders');
	Route::get('/search/all/posts/{query}', 'SearchController@seeAllSearchPosts')->name('search.allPosts');
	Route::get('/search/all/users/{query}', 'SearchController@seeAllSearchUsers')->name('search.allUsers');

	

	

});