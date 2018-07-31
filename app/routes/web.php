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
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function(){
	// Route admin home
	Route::get('/', 'AdminController@index')->name('admin.home')->middleware('checkLogin');
	Route::get('/home', 'AdminController@index')->name('admin.home')->middleware('checkLogin');
	Route::get('/login', 'UserController@login')->name('admin.login')->middleware('checkLogin');
	Route::get('/logout', 'UserController@logout')->name('admin.logout');
	Route::post('/loginPost', 'UserController@loginPost')->name('admin.loginPost');

	// Route Menu Santri
	Route::group(['prefix' => 'santri', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'SantriController@index')->name('admin.santri.index');
		Route::get('/create', 'SantriController@create')->name('admin.santri.create');
		Route::post('/store', 'SantriController@store')->name('admin.santri.store');
		Route::get('/edit/{id}', 'SantriController@edit')->name('admin.santri.edit');
		Route::put('/update/{id}', 'SantriController@update')->name('admin.santri.update');
		Route::get('/destroy/{id}', 'SantriController@delete')->name('admin.santri.destroy');
	});

	// Route Menu Tipe Pembayaran
	Route::group(['prefix' => 'tipe_pembayaran', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'PaymentTypeController@index')->name('admin.paymenttype.index');
		Route::get('/create', 'PaymentTypeController@create')->name('admin.paymenttype.create');
		Route::post('/store', 'PaymentTypeController@store')->name('admin.paymenttype.store');
		Route::get('/edit/{id}', 'PaymentTypeController@edit')->name('admin.paymenttype.edit');
		Route::put('/update/{id}', 'PaymentTypeController@update')->name('admin.paymenttype.update');
		Route::get('/destroy/{id}', 'PaymentTypeController@delete')->name('admin.paymenttype.destroy');
	});

	// Route Menu Transaksi
	Route::group(['prefix' => 'transaksi', 'middleware' => 'checkLogin'], function(){
		Route::get('/{id?}', 'TransactionController@index')->name('admin.transaction.index');
		Route::get('/create', 'TransactionController@create')->name('admin.transaction.create');
		Route::post('/store', 'TransactionController@store')->name('admin.transaction.store');
		Route::get('/edit/{id}', 'TransactionController@edit')->name('admin.transaction.edit');
		Route::put('/update/{id}', 'TransactionController@update')->name('admin.transaction.update');
		Route::get('/destroy/{id}', 'TransactionController@delete')->name('admin.transaction.destroy');

		// opotional
		Route::get('/payment/{id}', 'TransactionController@getPaymentType')->name('admin.transaction.getPaymentType');
	});

	// Route Menu User
	Route::group(['prefix' => 'user', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'UserController@index')->name('admin.user.index');
		Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
		Route::put('/update/{id}', 'UserController@update')->name('admin.user.update');
	});
});
