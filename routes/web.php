<?php

use Illuminate\Support\Facades\Route;
use App\Post;

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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/edit/profile', 'UserController@showUserEditForm')->name('user.showUserEditForm');
	Route::put('/edit/profile/update/{id}', 'UserController@update')->name('user.update');
	Route::get('/profile/user/{userName}', 'UserController@profile')->name('user.profile');
	Route::post('/search/name', 'UserController@nameList')->name('nameSearch');
	Route::get('/search/user/{query}', 'UserController@nameListAllResults')->name('nameListAllResults');
	Route::get('/create/post', 'HomeController@createPost')->name('createPost');
	Route::post('/post/image/create', 'PostController@imagePost')->name('image.createPost');
	Route::post('/post/video/create', 'PostController@videoPost')->name('video.createPost');
	Route::get('/post/checkSlug', 'PostController@checkSlug')->name('posts.checkSlug');
	Route::get('/post/download/{download_id}', 'PostController@downloadable')->name('posts.downloadable');
	Route::post('/post/upVote', 'PostController@upVotePost')->name('upVotePost');
	Route::post('/post/downVote', 'PostController@downVotePost')->name('downVotePost');
	Route::post('/post/video/upload', 'PostController@uploadVideo')->name('uploadVideo');
	Route::delete('/post/video/delete/{id}', 'PostController@deleteUploadedVideo')->name('deleteUploadedVideo');

	// Route::get('/test', function () {
	//     $post = Post::first();
	//     dd($post->getMedia('video')->first()->getPath());
	// });

});