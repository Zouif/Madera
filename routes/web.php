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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth
Route::post('/login/custom', [
    'uses' => 'Auth\LoginController@login',

    'as' => 'login.custom',
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', function(){
        return view('home');
    })->name('home');

    // Client
    Route::get('/searchClients', 'ClientController@search');
    Route::resource('clients', 'ClientController');

    //Projet
    Route::get('/searchProjets', 'ProjetController@search');
    Route::resource('projets', 'ProjetController');

    //Devis
    Route::get('/devis/delete/module', [
        'uses' => 'DevisController@deleteModule'
    ]);
    Route::resource('devis', 'DevisController');

    //Module
    Route::get('/modules', 'ModuleController@index');
    Route::get('/searchModules', 'ModuleController@search');
    Route::get('/devis/create/module', [
        'uses' => 'ModuleController@sendToDevis'
    ]);
    Route::resource('modules', 'ModuleController');

    //Couverture
    Route::get('/couvertures', 'CouvertureController@index');
    Route::get('/searchCouvertures', 'CouvertureController@search');
    Route::get('/devis/create/couverture', [
        'uses' => 'CouvertureController@sendToDevis'
    ]);
    Route::resource('couvertures', 'CouvertureController');

    //Cctp
    Route::get('/searchCctp', 'CctpController@search');
    Route::get('/devis/create/cctp', [
        'uses' => 'CctpController@sendToDevis'
    ]);
    Route::resource('cctps', 'CctpController');

    //Coupe Principe
    Route::resource('coupeprincipes', 'CoupeprincipeController');
    Route::get('/searchCoupeprincipes', 'CoupeprincipeController@search');
    Route::get('/devis/create/coupeprincipe', [
        'uses' => 'CoupeprincipeController@sendToDevis'
    ]);

    //Gamme
    Route::get('/gammes', 'GammeController@index');
    Route::get('/searchGammes', 'GammeController@search');
    Route::get('/devis/create/gamme', [
        'uses' => 'GammeController@sendToDevis'
    ]);
    Route::resource('gammes', 'GammeController');

});