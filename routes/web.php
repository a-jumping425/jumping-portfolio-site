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
        Route::get('portfolio/category', 'Backend\PortfolioCategoryController@showCategories');

        Route::post('portfolio/category/save', 'Backend\PortfolioCategoryController@saveCategory');

        Route::post('portfolio/category/delete/{id}', 'Backend\PortfolioCategoryController@deleteCategory')->where('id', '[0-9]+');

        Route::get('portfolio/category/edit/{id}', 'Backend\PortfolioCategoryController@editCategory')->where('id', '[0-9]+');

        Route::post('portfolio/category/reorder', 'Backend\PortfolioCategoryController@reorderCategory');

        /**
         * Portfolio skill
         */
        Route::get('portfolio/skill', 'Backend\PortfolioSkillController@showSkills');

        Route::post('portfolio/skill/save', 'Backend\PortfolioSkillController@saveSkill');

        Route::post('portfolio/skill/delete/{id}', 'Backend\PortfolioSkillController@deleteSkill')->where('id', '[0-9]+');

        Route::get('portfolio/skill/edit/{id}', 'Backend\PortfolioSkillController@editSkill')->where('id', '[0-9]+');

    /**
     * User
     */
    Route::get('user/new', 'Backend\UserController@newUser');
});
