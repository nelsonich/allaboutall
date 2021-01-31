<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index');
Route::post('/get-data', 'WelcomeController@getChildData');
Route::get('/search/{id?}/{text?}', 'WelcomeController@search');
Route::get('/p/{id?}', 'WelcomeController@renderParentCategoryPage');
Route::get('/info-p/{parent_id?}/{child_id}', 'WelcomeController@renderPageInformation')->middleware('isActiveInfo');
Route::get('/add-link-count/{id?}', 'WelcomeController@addLinkCount');

Auth::routes();

Route::get('/register', function ():void {abort(404);});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'Dashboard\CategoriesController@index');
        Route::get('/{id?}', 'Dashboard\CategoriesController@getChildCategories');
        Route::post('/add', 'Dashboard\CategoriesController@createCategory')->name('category.add');
        Route::post('/update', 'Dashboard\CategoriesController@updateCategory')->name('category.update');
        Route::post('/delete', 'Dashboard\CategoriesController@deleteCategory')->name('category.delete');

        Route::prefix('child')->group(function () {
            Route::post('/add', 'Dashboard\CategoriesController@createCategoryChild')->name('category-child.add');
            Route::post('/update', 'Dashboard\CategoriesController@updateCategoryChild')->name('category-child.update');
            Route::post('/delete', 'Dashboard\CategoriesController@deleteCategoryChild')->name('category-child.delete');
            Route::post('/add-search-tags', 'Dashboard\CategoriesController@addSearchTags')->name('category-child.addSearchTags');
            Route::post('/change-active', 'Dashboard\CategoriesController@changeActiveCategoryChild')->name('category-child.changeActive');
            Route::post('/add-carousel-item', 'Dashboard\CategoriesController@addCarouselItem')->name('add-carousel-item');
            Route::get('/remove-carousel-item/{id?}', 'Dashboard\CategoriesController@removeCarouselItem');
        });
    });
});
