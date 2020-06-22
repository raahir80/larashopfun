<?php



/*

Admin Routes
*/

Route::prefix('admin')->group(function(){


	Route::middleware('auth:admin')->group(function(){

		//Dashboard

	Route::get('/','DashboardController@index');


	//Products

	Route::resource('/products','ProductController');


	//orders
	Route::resource('/orders','OrderController');


	Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
	Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

	//users
	Route::resource('/users','UsersController');
	Route::get('/active/{id}','UsersController@active')->name('user.active');
	Route::get('/blocked/{id}','UsersController@blocked')->name('user.blocked');


	Route::get('/logout','AdminUserController@logout');



});
	
	//Admin login
	Route::get('/login','AdminUserController@index');	

	Route::post('/login','AdminUserController@store');

});



/*
Front end routes
*/

Route::get('/','Front\HomeController@index');
/*Route::get('/',function(){
	return view('front.index');
});*/


// User registration

Route::get('/user/register','Front\RegistrationController@index');
Route::post('/user/register','Front\RegistrationController@store');


// User login
Route::get('/user/login','Front\SessionsController@index');
Route::post('/user/login','Front\SessionsController@store');


// logout

Route::get('/user/logout','Front\SessionsController@logout');

Route::get('/user/profile',function(){

	return 'Welcome User';
});


Route::get('/user/profile/','Front\UserProfileController@index');

Route::get('/user/order/{id}','Front\UserProfileController@show');


//cart
Route::get('/cart','Front\CartController@index');
Route::post('/','Front\CartController@store')->name('cart');
Route::patch('/cart/update/{product}','Front\CartController@update')->name('cart.update');
Route::delete('/cart/remove/{product}','Front\CartController@destroy')->name('cart.destroy');

Route::post('/cart/savelater/{product}','Front\CartController@savelater')->name('cart.savelater');



Route::delete('/saveLater/destroy/{product}','Front\SaveLaterController@destroy')->name('saveLater.destroy');
Route::post('cart/moveToCart/{product}','Front\SaveLaterController@moveToCart')->name('moveToCart');


//checkout

Route::get('/checkout','Front\CheckoutController@index');

Route::post('/checkout','Front\CheckoutController@store')->name('checkout');

Route::get('empty',function(){
	Cart::instance('default')->destroy();
});


