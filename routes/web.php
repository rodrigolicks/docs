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

Route::group(['middleware' => 'auth'], function () {

    // revisao
    Route::group(['prefix' => 'revisoes', 'where' => ['id' => '[0-9]+', 'documento_id' => '[0-9]+']], function() {
        //Route::get('',              ['as' => 'habitos',           'uses' => 'RevisaoController@index']);
        Route::any('',              ['as' => 'revisoes',           'uses' => 'RevisoesController@index']);
        Route::get('create/{documento_id?}',['as' => 'revisoes.create',    'uses' => 'RevisoesController@create']);
        Route::get('{id}/destroy',  ['as' => 'revisoes.destroy',   'uses' => 'RevisoesController@destroy']);
        Route::get('{id}/edit',     ['as' => 'revisoes.edit',      'uses' => 'RevisoesController@edit']);
        //Route::get('getdoc/{id}',   ['as' => 'revisoes.store',     'uses' => 'RevisoesController@getDoc']);                
        Route::put('{id}/update',   ['as' => 'revisoes.update',    'uses' => 'RevisoesController@update']);
        Route::post('store',        ['as' => 'revisoes.store',     'uses' => 'RevisoesController@store']);
        
    });

    // documentos
    Route::group(['prefix' => 'documentos', 'where' => ['id' => '[0-9]+']], function() {  
        Route::get('',              ['as' => 'documentos',           'uses' => 'DocumentosController@index']);
        Route::get('create',        ['as' => 'documentos.create',    'uses' => 'DocumentosController@create']);
        Route::get('{id}/destroy',  ['as' => 'documentos.destroy',   'uses' => 'DocumentosController@destroy']);
        Route::get('{id}/edit',     ['as' => 'documentos.edit',      'uses' => 'DocumentosController@edit']);
        Route::put('{id}/update',   ['as' => 'documentos.update',    'uses' => 'DocumentosController@update']);
        Route::post('store',        ['as' => 'documentos.store',     'uses' => 'DocumentosController@store']);

        // Rotas do master/detail de documentos
        Route::get('createmaster',  ['as' => 'documentos.createmaster', 'uses' => 'DocumentosController@createmaster']);
        Route::post('masterdetail', ['as' => 'documentos.masterdetail', 'uses' => 'DocumentosController@masterdetail']);
    });
    
    // API Google drive
    Route::get('get/{filename}', function($filename) {
        $contents = collect(Storage::cloud()->listContents('/', false));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();
    
        $rawData = Storage::cloud()->get($file['path']);
    
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    });    

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
