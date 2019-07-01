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
	Route::get('/login', 'UserController@login')->name('admin.login');
	Route::get('/logout', 'UserController@logout')->name('admin.logout');
	Route::post('/loginPost', 'UserController@loginPost')->name('admin.loginPost');

	Route::get('/register', 'UserController@registerPost')->name('admin.registerPost');

	// Route Menu Santri
	Route::group(['prefix' => 'santri', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'SantriController@index')->name('admin.santri.index');
		Route::get('/create', 'SantriController@create')->name('admin.santri.create');
		Route::post('/store', 'SantriController@store')->name('admin.santri.store');
		Route::get('/edit/{id}', 'SantriController@edit')->name('admin.santri.edit');
		Route::put('/update/{id}', 'SantriController@update')->name('admin.santri.update');
		Route::get('/destroy/{id}', 'SantriController@destroy')->name('admin.santri.destroy');

		//opotional
		Route::get('/show/{id}', 'SantriController@show')->name('admin.santri.show');
		Route::get('/detail/{id}/{yearSearch?}', 'SantriController@detail')->name('admin.santri.detail');
	});

	// Route Menu Tipe Pembayaran
	Route::group(['prefix' => 'tipe_pembayaran', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'PaymentTypeController@index')->name('admin.paymenttype.index');
		Route::get('/create', 'PaymentTypeController@create')->name('admin.paymenttype.create');
		Route::post('/store', 'PaymentTypeController@store')->name('admin.paymenttype.store');
		Route::get('/edit/{id}', 'PaymentTypeController@edit')->name('admin.paymenttype.edit');
		Route::put('/update/{id}', 'PaymentTypeController@update')->name('admin.paymenttype.update');
		Route::get('/destroy/{id}', 'PaymentTypeController@destroy')->name('admin.paymenttype.destroy');
	});

	// Route Menu Transaksi
	Route::group(['prefix' => 'transaksi', 'middleware' => 'checkLogin'], function(){
		Route::get('/create', 'TransactionController@create')->name('admin.transaction.create');
		Route::get('/{id?}', 'TransactionController@index')->name('admin.transaction.index');
		Route::post('/store', 'TransactionController@store')->name('admin.transaction.store');
		Route::get('/edit/{id}', 'TransactionController@edit')->name('admin.transaction.edit');
		Route::put('/update/{id}', 'TransactionController@update')->name('admin.transaction.update');
		Route::get('/destroy/{id}', 'TransactionController@destroy')->name('admin.transaction.destroy');

		// opotional
		Route::get('/show/{id}', 'TransactionController@show')->name('admin.transaction.show');
		Route::get('/payment/{id}', 'TransactionController@getPaymentType')->name('admin.transaction.getPaymentType');
		Route::get('/print/{id}', 'TransactionController@printPdf')->name('admin.transaction.print');
	});

	// Route Laporan
	Route::group(["prefix" => "laporan", "middleware" => "checkLogin"], function()
	{
	    Route::get('/', 'ReportController@index')->name("admin.report.index");

	    // Report Santri
	    Route::get('/santri', 'ReportController@santri')->name('admin.report.santri.index');
	    Route::get('/santri/search', 'ReportController@santriSearch')->name('admin.report.santri.search');
	    Route::get('/santri/export', 'ReportController@santriExport')->name('admin.report.santri.export');

	    // Report Transaksi
	    Route::get('/transaksi', 'ReportController@transaksi')->name('admin.report.transaksi.index');
	    Route::get('/transaksi/search', 'ReportController@transaksiSearch')->name('admin.report.transaksi.search');
	    Route::get('/transaksi/export', 'ReportController@transaksiExport')->name('admin.report.transaksi.export');
	    Route::get('/transaksi/export/excel', 'ReportController@transaksiExportExcel')->name('admin.report.transaksi.export.excel');
	});

	// Route Menu User
	Route::group(['prefix' => 'user', 'middleware' => 'checkLogin'], function(){
		Route::get('/', 'UserController@index')->name('admin.user.index');
		Route::get('/create', 'UserController@create')->name('admin.user.create');
		Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
		Route::post('/store', 'UserController@store')->name('admin.user.store');
		Route::put('/update/{id}', 'UserController@update')->name('admin.user.update');
	});

	// Route Pesantren Profile
	Route::group(["prefix" => "pesantrenprofile", "middleware" => "checkLogin"], function()
	{
	    Route::get('/', 'PesantrenProfileController@index')->name("admin.pesantrenprofile.index");
	    Route::get('/create', 'PesantrenProfileController@create')->name("admin.pesantrenprofile.create");
	    Route::post('/store', 'PesantrenProfileController@store')->name("admin.pesantrenprofile.store");
	    Route::get('/show/{id}', 'PesantrenProfileController@show')->name("admin.pesantrenprofile.show");
	    Route::get('/edit/{id}', 'PesantrenProfileController@edit')->name("admin.pesantrenprofile.edit");
	    Route::put('/update/{id}', 'PesantrenProfileController@update')->name("admin.pesantrenprofile.update");
	    Route::get('/destroy/{id}', 'PesantrenProfileController@destroy')->name("admin.pesantrenprofile.destroy");
	});

	// Dropdown Daerah
    Route::post('/dropdownDaerah', 'DropdownAddressController@postDropdown')->name('dropdownAddress');
});
