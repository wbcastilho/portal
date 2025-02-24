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

    Route::prefix('cadastros')->group(function () {
      Route::resource('fabricantes', 'FabricanteController');
      Route::resource('setores', 'SetorController');
      Route::resource('tipos', 'TipoController');   
      Route::resource('usuarios', 'UsuarioController');   
      Route::resource('modelos', 'ModeloController');  

      Route::get('fornecedores/cidades/{id}', 'EstadoController@getCidades');
      Route::resource('fornecedores', 'FornecedorController');  

      Route::post('permissoes/{nivel_id}/{permissao_id}/excluir', 'PermissaoController@excluir');
      Route::resource('permissoes', 'PermissaoController');  
      
      Route::prefix('localizacoes')->group(function () {    
        Route::resource('localizacao1', 'Localizacao1Controller');   
        Route::get('localizacao1/cidades/{id}', 'EstadoController@getCidades');
        
        Route::resource('localizacao2', 'Localizacao2Controller');
        Route::get('localizacao2/cidades/{id}', 'EstadoController@getCidades');
        Route::get('localizacao2/getlocalizacao1/{id}', 'CidadeController@getLocalizacao1');     
      
        Route::resource('localizacao3', 'Localizacao3Controller');
        Route::get('localizacao3/cidades/{id}', 'EstadoController@getCidades');
        Route::get('localizacao3/getlocalizacao1/{id}', 'CidadeController@getLocalizacao1');     
        Route::get('localizacao3/getlocalizacao2/{id}', 'Localizacao1Controller@getLocalizacao2');

        Route::resource('localizacao4', 'Localizacao4Controller');
        Route::get('localizacao4/cidades/{id}', 'EstadoController@getCidades');
        Route::get('localizacao4/getlocalizacao1/{id}', 'CidadeController@getLocalizacao1');     
        Route::get('localizacao4/getlocalizacao2/{id}', 'Localizacao1Controller@getLocalizacao2');
        Route::get('localizacao4/getlocalizacao3/{id}', 'Localizacao2Controller@getLocalizacao3');     
      });
    });

    //Route::post('equipamentos/movimentacao/{id}', 'EquipamentoController@movimentacao')->name('equipamentos.movimentacao');
    Route::get('equipamentos/{id}/movimentar', 'EquipamentoController@movimentar')->name('equipamentos.movimentar');
    Route::post('equipamentos/{id}/movimentar/movimentacao', 'EquipamentoController@movimentacao')->name('equipamentos.movimentacao');
    
    Route::resource('equipamentos', 'EquipamentoController');   
    Route::post('equipamentos/{id}/excluir', 'EquipamentoController@excluir');
    Route::get('equipamentos/getmodelos/{fabricante_id}/{tipo_id}', 'ModeloController@getModelos1');
    Route::get('equipamentos/{id}/getmodelos/{fabricante_id}/{tipo_id}', 'ModeloController@getModelos2');
    Route::get('equipamentos/cidades/{id}', 'EstadoController@getCidades');
    Route::get('equipamentos/getlocalizacao1/{id}', 'CidadeController@getLocalizacao1');
    Route::get('equipamentos/getlocalizacao2/{id}', 'Localizacao1Controller@getLocalizacao2');
    Route::get('equipamentos/getlocalizacao3/{id}', 'Localizacao2Controller@getLocalizacao3');
    Route::get('equipamentos/getlocalizacao4/{id}', 'Localizacao3Controller@getLocalizacao4');

    Route::get('equipamentos/{equipamento_id}/cidades/{id}', 'EstadoController@getCidades2');
    Route::get('equipamentos/{equipamento_id}/getlocalizacao1/{id}', 'CidadeController@getLocalizacao1_2');
    Route::get('equipamentos/{equipamento_id}/getlocalizacao2/{id}', 'Localizacao1Controller@getLocalizacao2_2');
    Route::get('equipamentos/{equipamento_id}/getlocalizacao3/{id}', 'Localizacao2Controller@getLocalizacao3_2');
    Route::get('equipamentos/{equipamento_id}/getlocalizacao4/{id}', 'Localizacao3Controller@getLocalizacao4_2');
  
    Route::get('/home', 'HomeController@index')->name('home');
});
