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
Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastar']);


/**
 * Routes to user auth
 * ========================================================================
 */
Route::get('/login', ['uses' => 'Controller@fazerLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);

Route::get('user/movement', ['as' => 'movement.index', 'uses' => 'MovementsController@index']);

Route::get('getback', ['as' => 'movement.getback', 'uses' => 'MovementsController@getback']);
Route::post('getback', ['as' => 'movement.getback.store', 'uses' => 'MovementsController@storeGetback']);

Route::get('movement', ['as' => 'movement.application', 'uses' => 'MovementsController@application']);
Route::post('movement', ['as' => 'movement.application.store', 'uses' => 'MovementsController@storeApplication']);

Route::get('movement/all',['as' => 'movement.all', 'uses' => 'MovementsController@all']);

Route::resource('user', 'UsersController');
Route::resource('institution', 'InstitutionsController');
Route::resource('group', 'GroupsController');
Route::resource('institution.product', 'ProductsController');


#Route::get('group', 'GroupsController@index');
#Route::post('group', 'GroupsController@store');
#Route::get('group/{id}', 'GroupsController@show');
#Route::update('group/{id}', 'GroupsController@update');
#Route::delete('group/{id}', 'GroupsController@delete');


Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);











