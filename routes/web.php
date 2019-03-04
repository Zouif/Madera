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
    //Route::get('/projets?search=(.*)', 'ProjetController@search');
    Route::resource('projets', 'ProjetController');

    //Devis
    Route::resource('devis', 'DevisController');

    //Module
    Route::get('/modules', 'ModuleController@index');
    Route::get('/searchModules', 'ModuleController@search');
    Route::resource('modules', 'ModuleController');

});



//Devis
//Route::resource('devis', 'DevisController');
//Route::get('projets/{ref}/devis', function(){
//    return view('devis.index');
//})->name('devis');


// Client
//Route::get('/searchClients', 'ClientController@search');
//Route::resource('clients', 'ClientController');
//
////Projet
//Route::get('/searchProjets', 'ProjetController@search');
//Route::resource('projets', 'ProjetController');
//
////Devis
//Route::get('/projets/{ref}/devis', 'DevisController@index');