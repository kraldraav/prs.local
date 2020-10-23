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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/add', 'EventsController@add')->name('add');
Route::get('/report', 'EventsController@report')->name('event_report');
Route::post('/report', 'EventsController@generateReport');
Route::get('/reprint/{id}', 'EventsController@reprint')->name('reprint');
Route::post('/create', 'EventsController@create');
Route::get('/dependences', 'Cartdependences@index')->name('dependences');
Route::get('/dependences/add', 'Cartdependences@add')->name('add_dependence');
Route::get('/dependences/edit/{id}', 'Cartdependences@edit')->name('edit_dependence');
Route::post('/dependences/create', 'Cartdependences@create')->name('create_dependence');
Route::post('/dependences/save', 'Cartdependences@save')->name('save_dependence');
Route::get('/edit_profile', 'UserController@edit')->name('edit_profile');
Route::post('/change_profile', 'UserController@change')->name('change_profile');
Route::get('/cartridges/get/{p_id}', 'EventsController@getCartridges');
Route::get('/cartridges/desc/{c_id}', 'EventsController@getDescCart');
Route::get('/cartridges', 'CartridgeController@index')->name('cartridges');
Route::get('/cartridges/add', 'CartridgeController@add')->name('add_cartridge');
Route::get('/cartridges/edit/{id}', 'CartridgeController@edit')->name('edit_cartridge');
Route::post('/cartridges/save', 'CartridgeController@save')->name('save_cartridge');
Route::post('/cartridges/create', 'CartridgeController@create')->name('create_cartridge');
Route::get('/printers', 'PrinterController@index')->name('printers');
Route::get('/printers/add', 'PrinterController@add')->name('add_printer');
Route::get('/printers/edit/{id}', 'PrinterController@edit')->name('edit_printer');
Route::post('/printers/save', 'PrinterController@save')->name('save_printer');
Route::post('/printers/create', 'PrinterController@create')->name('create_printer');
Route::get('/lockevents', 'LockeventsController@index')->name('lockevents');
Route::get('/lockevents/add', 'LockeventsController@add')->name('add_lockevents');
Route::get('/lockevents/room/{id}', 'LockeventsController@detail')->name('detail_room');
Route::get('/lockevents/report', 'LockeventsController@report')->name('lockevents_report');
Route::post('/lockevents/report', 'LockeventsController@generateReport');
Route::post('/lockevents/create', 'LockeventsController@create')->name('create_lockevents');
Route::get('/troubletypes/add', 'TroubletypesController@add')->name('add_troubletypes');
Route::post('/troubletypes/create', 'TroubletypesController@create')->name('create_troubletypes');
Route::get('/emails', 'EmailController@index')->name('emails');
Route::get('/emails/changeRedirect/{address}', 'EmailController@changeRedirect');
Route::post('/emails/changeRedirectAction', 'EmailController@changeRedirectAction');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
