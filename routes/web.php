<?php

use App\User;
use App\Models\RBAC\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Services\PermissionResponseService;

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

View::composer('layouts.appDashboard', function($view)
{
    $permissions = new PermissionResponseService();
    $auth = User::where('id', \auth()->id())->with('role')->first();
    $array = Permission::where('parent_id', null)->get();

    $view->with(
        [
            'permissions' => $permissions->get($auth->role->id, $array),
            'role' => $auth->role,
        ]);
});


Route::get('/', 'WelcomeController@index');
Route::post('/get-data', 'WelcomeController@getChildData');
Route::get('/search/{id?}/{text?}', 'WelcomeController@search');
Route::get('/p/{id?}', 'WelcomeController@renderParentCategoryPage');
Route::get('/info-p/{parent_id?}/{child_id}', 'WelcomeController@renderPageInformation')->middleware('isActiveInfo');
Route::get('/add-link-count/{id?}', 'WelcomeController@addLinkCount');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'Dashboard\CategoriesController@index')->middleware('permission');
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

    Route::prefix('permissions')->group(function () {
        Route::get('/', 'Dashboard\PermissionController@index')->middleware('permission');
        Route::get('/get-by-role/{id?}', 'Dashboard\PermissionController@getByRole');
        Route::put('/change-permission', 'Dashboard\PermissionController@changePermission')->name('change-permission');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'Dashboard\UsersController@index')->middleware('permission');
        Route::post('/add', 'Dashboard\UsersController@addUser')->name('users.add');
        Route::post('/delete', 'Dashboard\UsersController@deleteUser')->name('users.delete');
        Route::post('/update', 'Dashboard\UsersController@editUser')->name('users.update');
    });
});
