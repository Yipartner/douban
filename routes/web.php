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

//Route::get('/', function () {
//    return view('welcome');
//});

// 详情
Route::get('/movie', 'MovieController@getMovieById');
// 按属性查
Route::get('/movie/tag', 'MovieController@getMovieByTag');
Route::get('/movie/writer', 'MovieController@getMovieByWriter');
Route::get('/movie/actor', 'MovieController@getMovieByActor');
// 多属性联查
Route::get('/movie/condition', 'MovieController@getMovieByCondition');
// 按属性分组查询
Route::get('/movie/count/info', 'MovieController@getMovieCountByProp');
