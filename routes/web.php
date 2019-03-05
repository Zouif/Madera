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


    //Produit
    Route::get('/devis/delete/produit', [
        'uses' => 'ProduitController@deleteModule'
    ]);
    Route::get('/devis/deleteCreate/produit', [
        'uses' => 'ProduitController@deleteModuleCreate'
    ]);
    Route::get('/produit/prepareedit', [
        'uses' => 'ProduitController@prepareedit'
    ]);
    Route::resource('produits', 'ProduitController');

    //Module
    Route::get('/modules', 'ModuleController@index');
    Route::get('/searchModules', 'ModuleController@search');
    Route::get('/produits/create/module', [
        'uses' => 'ModuleController@sendToDevis'
    ]);
    Route::resource('modules', 'ModuleController');

    //Couverture
    Route::get('/couvertures', 'CouvertureController@index');
    Route::get('/searchCouvertures', 'CouvertureController@search');
    Route::get('/produits/create/couverture', [
        'uses' => 'CouvertureController@sendToDevis'
    ]);
    Route::resource('couvertures', 'CouvertureController');

    //Cctp
    Route::get('/searchCctp', 'CctpController@search');
    Route::get('/produits/create/cctp', [
        'uses' => 'CctpController@sendToDevis'
    ]);
    Route::resource('cctps', 'CctpController');

    //Coupe Principe
    Route::resource('coupeprincipes', 'CoupeprincipeController');
    Route::get('/searchCoupeprincipes', 'CoupeprincipeController@search');
    Route::get('/produits/create/coupeprincipe', [
        'uses' => 'CoupeprincipeController@sendToDevis'
    ]);

    //Gamme
    Route::get('/gammes', 'GammeController@index');
    Route::get('/searchGammes', 'GammeController@search');
    Route::get('/produits/create/gamme', [
        'uses' => 'GammeController@sendToDevis'
    ]);
    Route::resource('gammes', 'GammeController');

});