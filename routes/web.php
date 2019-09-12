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

Auth::routes();

//Grupo de rotas protegidas da área administrativa
Route::group(['middleware' => 'auth','prefix' => '/'], function(){
    Route::get('/', function () {
      return view('site/home');
    });

    Route::get('/home', function () {
        return view('site/home');
      });

    Route::get('/dashboard', function () {
        return view('site/home');
      });

    /*Route::get('/', function () {
        return view('welcome');
    });*/

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/teste', 'TesteController@index')->name('teste');

    Route::resource('fabricantes', 'FabricanteController');
    Route::resource('setores', 'SetorController');
    Route::resource('tipos', 'TipoController');   
    Route::resource('usuarios', 'UsuarioController');   
    Route::resource('modelos', 'ModeloController');  
    
    Route::prefix('localizacoes')->group(function () {
      Route::resource('localizacao1', 'Localizacao1Controller');   
      Route::get('localizacao1/cidades/{id}', 'EstadoController@getCidades');
      Route::resource('localizacao2', 'Localizacao2Controller');   
      Route::get('localizacao2/cidades/{id}', 'EstadoController@getCidades');
    });

  

    Route::get('/home', 'HomeController@index')->name('home');
});
