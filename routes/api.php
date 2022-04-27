<?php

use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace("Api")->group(function () {
    Route::get('/categories', "SiteController@categories");
    Route::get('/get-welcome-page-info', "SiteController@index");
    Route::post('/subscribe', 'SiteController@subscribe');
    Route::post('/get-data', 'SiteController@getChildData');
    Route::get('/search/{id?}/{text?}', 'SiteController@search');
    Route::get('/p/{id?}', 'SiteController@renderParentCategoryPage');
    Route::get('/add-link-count/{id?}', 'SiteController@addLinkCount');
    Route::get('/info-p/{parent_id?}/{child_id}', 'SiteController@renderPageInformation')->middleware('isActiveInfo');

    // extension
    Route::get('/ping', "SiteController@ping");
    Route::post('/scrubbing', "SiteController@scrubbing");
});
