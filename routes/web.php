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

Route::group([], function () {
    Route::get('/', 'Frontend\HomeController@index');
    Route::get('contact', 'Frontend\ContactController@index');
    Route::get('portfolio', 'Frontend\PortfolioController@index');
});

Route::group(['prefix' => 'admin_1lkh6x', 'middleware' => ['auth']], function () {
    /**
     * Dashboard
     */
    Route::get('/', 'Backend\DashboardController@show');

    /**
     * Portfolio
     */
    Route::get('portfolios', 'Backend\PortfolioController@showPortfolios');
    Route::get('portfolio/get_portfolios_api', 'Backend\PortfolioController@getPortfoliosAPI');
    Route::post('portfolio/reorder', 'Backend\PortfolioController@reorderPortfolio');
    Route::get('portfolio/new', 'Backend\PortfolioController@newPortfolio');
    Route::get('portfolio/edit/{id}', 'Backend\PortfolioController@editPortfolio')->where('id', '[0-9]+');
    Route::post('portfolio/save', 'Backend\PortfolioController@savePortfolio');
    Route::post('portfolio/delete/{id}', 'Backend\PortfolioController@deletePortfolio')->where('id', '[0-9]+');
    Route::get('portfolio/uploaded_files_api/{id}', 'Backend\PortfolioController@uploadedFilesAPI')->where('id', '[0-9]+');
    Route::post('portfolio/upload_file', 'Backend\PortfolioController@uploadFile');
    Route::get('portfolio/delete_file', 'Backend\PortfolioController@deleteFile');

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
    Route::get('user/edit/{id}', 'Backend\UserController@editUser')->where('id', '[0-9]+');
    Route::post('user/save', 'Backend\UserController@saveUser');
    Route::post('user/delete/{id}', 'Backend\UserController@deleteUser')->where('id', '[0-9]+');
    Route::get('user/profile', 'Backend\UserController@userProfile');
});

Route::group(['prefix' => 'admin_1lkh6x'], function () {
    // Authentication Routes...
    Route::get('login', 'Backend\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Backend\Auth\LoginController@login');
    Route::get('logout', 'Backend\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Backend\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Backend\Auth\ResetPasswordController@reset');
});
