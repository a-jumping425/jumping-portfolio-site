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

//Route::group(['middleware' => 'auth'], function () {
Route::group([], function () {
    Route::get('login', function () {
        return view('backend/auth/login');
    });

    Route::get('/', 'Backend\DashboardController@show');

    /**
     * Portfolio
     */
    Route::get('portfolio', 'Backend\PortfolioController@showPortfolios');

    /**
     * Portfolio category
     */
    Route::get('portfolio/category', 'Backend\PortfolioController@showCategories');

    Route::post('portfolio/category/save', 'Backend\PortfolioController@saveCategory');

    Route::post('portfolio/category/delete/{id}', 'Backend\PortfolioController@deleteCategory')->where('id', '[0-9]+');

    /**
     * User
     */
    Route::get('user/new', 'Backend\UserController@newUser');
});
