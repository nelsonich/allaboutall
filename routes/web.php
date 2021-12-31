<?php

use App\Services\UserService;
use App\Models\RBAC\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
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
    $auth = new UserService();
    $array = Permission::where('parent_id', null)->get();

    $view->with(
        [
            'permissions' => $permissions->get($auth->getById(\auth()->id())->role->id, $array),
            'role' => $auth->getById(\auth()->id())->role,
        ]);
});

Route::get('/', 'WelcomeController@index');
// Route::post('/subscribe', 'WelcomeController@subscribe');
// Route::post('/get-data', 'WelcomeController@getChildData');
// Route::get('/search/{id?}/{text?}', 'WelcomeController@search');
Route::get('/p/{id?}', 'WelcomeController@renderParentCategoryPage');
// Route::get('/add-link-count/{id?}', 'WelcomeController@addLinkCount');
Route::get('/info-p/{parent_id?}/{child_id}', 'WelcomeController@renderPageInformation')->middleware('isActiveInfo');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->namespace('Dashboard')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoriesController@index')->middleware('permission');
        Route::get('/{id?}', 'CategoriesController@getChildCategories');
        Route::post('/add', 'CategoriesController@createCategory')->name('category.add');
        Route::post('/update', 'CategoriesController@updateCategory')->name('category.update');
        Route::get('/restore/{id}', 'CategoriesController@restoreCategory');
        Route::delete('/delete/{id}', 'CategoriesController@deleteCategory');

        Route::prefix('child')->group(function () {
            Route::post('/add', 'CategoriesController@createCategoryChild')->name('category-child.add');
            Route::post('/update', 'CategoriesController@updateCategoryChild')->name('category-child.update');
            Route::delete('/delete/{id}', 'CategoriesController@deleteCategoryChild');
            Route::post('/add-search-tags', 'CategoriesController@addSearchTags')->name('category-child.addSearchTags');
            Route::post('/change-active', 'CategoriesController@changeActiveCategoryChild')->name('category-child.changeActive');
            Route::post('/add-carousel-item', 'CategoriesController@addCarouselItem')->name('add-carousel-item');
            Route::get('/remove-carousel-item/{id?}', 'CategoriesController@removeCarouselItem');
        });
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', 'PermissionController@index')->middleware('permission');
        Route::get('/get-by-role/{id?}', 'PermissionController@getByRole');
        Route::put('/change-permission', 'PermissionController@changePermission')->name('change-permission');
        Route::post('/add', 'PermissionController@add')->name('permission.add');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UsersController@index')->middleware('permission');
        Route::post('/add', 'UsersController@addUser')->name('users.add');
        Route::post('/delete', 'UsersController@deleteUser')->name('users.delete');
        Route::post('/update', 'UsersController@editUser')->name('users.update');
        Route::get('/export-as-excel', 'UsersImportExportController@exportAsExcel')->name('export-users-as-excel');
    });

    Route::prefix('subscribers')->group(function () {
        Route::get('/', 'NewsLetterSubscribersController@index')->middleware('permission');
        Route::post('/add', 'NewsLetterSubscribersController@addUser')->name('users.add');
        Route::post('/delete', 'NewsLetterSubscribersController@delete')->name('subscribers.delete');
        Route::post('/update', 'NewsLetterSubscribersController@editUser')->name('users.update');
    });
});
