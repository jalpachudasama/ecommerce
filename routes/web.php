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
    return view('auth.login1');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/dash','DashboardController');

Route::resource('/admin','AdminController');

Route::resource('/state','StateController');

Route::resource('/city','CityController');

Route::resource('/category','CategoryController');

Route::resource('/subcategory','SubCategoryController');

Route::resource('/variationtype','VariationTypeController');

Route::resource('/variation','VariationController');

Route::resource('/product','ProductController');

Route::get('/jsmethod','VariationTypeController@adddiv');

Route::get('/stateajax','AdminController@statedata');

Route::get('/cityajax','AdminController@citydata');

Route::get('/search_admin','AdminController@searching');

Route::get('/search_state','StateController@searching');

Route::get('/search_city','CityController@searching');

Route::get('/search_cat','CategoryController@searching');
Route::post('/getsubcategory','ProductController@getsubcategory');
Route::get('/profile','AdminController@profile');
Route::post('/change_pass','AdminController@change_pass');

});

Route::resource('/front','FmainController');

Route::resource('/test','TestController');