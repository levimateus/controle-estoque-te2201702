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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/produtos', 'ProdutoController@index');
Route::get('/produtos/fornecedor/{id}', 'ProdutoController@listarPorFornecedor');
Route::get('/produtos/buscar', 'ProdutoController@buscar');
Route::get('/produtos/esgotados', 'ProdutoController@esgotados');
Route::post('/inserir/produto', 'ProdutoController@store');
Route::post('/debitar/produto', 'ProdutoController@debitar');
Route::post('/editar/produto', 'ProdutoController@editar');
Route::get('/fornecedores', 'FornecedorController@index');
Route::post('/inserir/fornecedor', 'FornecedorController@store');