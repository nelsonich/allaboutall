<?php

use App\Http\Controllers\Api\SiteController;
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
    Route::get('/get-welcome-page-info', [SiteController::class, 'index']);
    Route::get('/categories', [SiteController::class, 'categories']);
    Route::post('/subscribe', [SiteController::class, 'subscribe']);
    Route::post('/get-data', [SiteController::class, 'getChildData']);
    Route::get('/search/{id?}/{text?}', [SiteController::class, 'search']);
    Route::get('/p/{id?}', [SiteController::class, 'renderParentCategoryPage']);
    Route::get('/add-link-count/{id?}', [SiteController::class, 'addLinkCount']);
    Route::get('/info-p/{parent_id?}/{child_id}', [SiteController::class, 'renderPageInformation'])->middleware('isActiveInfo');

    // extension
    Route::get('/ping', [SiteController::class, 'ping']);
    Route::post('/scrubbing', [SiteController::class, 'scrubbing']);
});
