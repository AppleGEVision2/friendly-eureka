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


Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('signup', function () {
    return view('auth/register');
});

Route::get('home', function () {
    return view('home');
});

Route::get('/logout', 'HomeController@logout');
	
//Route::get('buy-details', ['uses' => 'homeController@getPosts']);
Route::get('my-posts', ['uses' => 'HomeController@myPosts']);

Route::get('sell', ['uses' => 'HomeController@getPosts']);

Route::post('startPost', function (){
	$postTitle = Request::input('postTitle');
	return view('buy-details', ['postTitle' => $postTitle]);
});

Route::post('createPost', function(){
	$postTitle = Request::input('postTitle');
	$qty= Request::input('qty');
	$price = Request::input('price');
	$userID = Auth::id();
	DB::table('posts')->insert(
		[ 'postTitle' => $postTitle, 'userID' => $userID,'postQTY' => $qty, 'postPrice' => $price ]
	);
	header('location:my-posts');
	die();
});

Route::post('editPost', function(){
	DB::table('posts')->where('postID', '=', Request::input('postID'))->delete();
	header('location:my-posts');
	die();
});






