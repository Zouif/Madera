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
    Route::get('/dashboard', function(){
        //si j'ai besoin que la route soit spécifique à un role, il faut retourner un controller (AdminController) pour gerer cela)
            return view('dashboard');
    })->name('dashboard');
});

// Client
Route::resource('clients', 'ClientController');
Route::get('/searchClients', 'ClientController@search');

//Projet
Route::resource('projets', 'ProjetController');
Route::get('/searchProjets', 'ProjetController@search');