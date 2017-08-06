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
    // Authentication Routes...
    Route::get('login', 'Backend\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Backend\Auth\LoginController@login');
    Route::post('logout', 'Backend\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Backend\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Backend\Auth\ResetPasswordController@reset');

    Route::get('/', 'Backend\DashboardController@show');

    /**
     * Portfolio
     */
    Route::get('portfolios', 'Backend\PortfolioController@showPortfolios');
    Route::get('portfolio/new', 'Backend\PortfolioController@editPortfolio');

    /**
     * Portfolio category
     */
    Route::get('portfolio/categories', 'Backend\PortfolioCategoryController@showCategories');
    Route::post('portfolio/category/save', 'Backend\PortfolioCategoryController@saveCategory');
    Route::post('portfolio/category/delete/{id}', 'Backend\PortfolioCategoryController@deleteCategory')->where('id', '[0-9]+');
    Route::get('portfolio/category/edit/{id}', 'Backend\PortfolioCategoryController@editCategory')->where('id', '[0-9]+');
    Route::post('portfolio/category/reorder', 'Backend\PortfolioCategoryController@reorderCategory');

    /**
     * Portfolio tag
     */
    Route::get('portfolio/tags', 'Backend\PortfolioTagController@showTags');
    Route::post('portfolio/tag/save', 'Backend\PortfolioTagController@saveTag');
    Route::post('portfolio/tag/delete/{id}', 'Backend\PortfolioTagController@deleteTag')->where('id', '[0-9]+');
    Route::get('portfolio/tag/edit/{id}', 'Backend\PortfolioTagController@editTag')->where('id', '[0-9]+');

    /**
     * User
     */
    Route::get('users', 'Backend\UserController@showUsers');
    Route::get('user/get_users', 'Backend\UserController@getUsers');
    Route::get('user/new', 'Backend\UserController@newUser');
    Route::post('user/save', 'Backend\UserController@saveUser');
    Route::post('user/delete/{id}', 'Backend\UserController@deleteUser')->where('id', '[0-9]+');
});
