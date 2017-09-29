<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('portfolio/get_categories', 'Api\PortfolioCategoryController@getCategories');

Route::post('portfolio/get_tags', 'Api\PortfolioTagController@getTags');

Route::post('portfolio/get_technologies', 'Api\PortfolioTechnologyController@getTechnologies');

Route::get('portfolio/loadmore', 'Api\PortfolioController@loadMore');
