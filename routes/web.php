<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\RBAC\Permission;
use App\Services\UserService;
use App\Services\PermissionResponseService;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\NewsLetterSubscribersController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\UsersImportExportController;

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

View::composer('layouts.appDashboard', function ($view) {
    $permissions = new PermissionResponseService();
    $auth = new UserService();
    $array = Permission::where('parent_id', null)->get();

    $view->with(
        [
            'permissions' => $permissions->get($auth->getById(\auth()->id())->role->id, $array),
            'role' => $auth->getById(\auth()->id())->role,
        ]
    );
});

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/need-workers', [WelcomeController::class, 'renderNeedWorkersPage']);
Route::post('/apply-to-work', [WelcomeController::class, 'applyToWork'])->name("apply-to-work");
Route::get('/p/{id?}', [WelcomeController::class, 'renderParentCategoryPage']);
Route::get('/info-p/{parent_id?}/{child_id}', [WelcomeController::class, 'renderPageInformation'])->middleware('isActiveInfo');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->namespace('Dashboard')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->middleware('permission');
        Route::get('/{id?}', [CategoriesController::class, 'getChildCategories']);
        Route::post('/add', [CategoriesController::class, 'createCategory'])->name('category.add');
        Route::post('/update', [CategoriesController::class, 'updateCategory'])->name('category.update');
        Route::get('/restore/{id}', [CategoriesController::class, 'restoreCategory']);
        Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory']);

        Route::prefix('child')->group(function () {
            Route::post('/add', [CategoriesController::class, 'createCategoryChild'])->name('category-child.add');
            Route::post('/update', [CategoriesController::class, 'updateCategoryChild'])->name('category-child.update');
            Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategoryChild']);
            Route::post('/add-search-tags', [CategoriesController::class, 'addSearchTags'])->name('category-child.addSearchTags');
            Route::post('/change-active', [CategoriesController::class, 'changeActiveCategoryChild'])->name('category-child.changeActive');
            Route::post('/add-carousel-item', [CategoriesController::class, 'addCarouselItem'])->name('add-carousel-item');
            Route::get('/remove-carousel-item/{id?}', [CategoriesController::class, 'removeCarouselItem']);
        });
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission');
        Route::get('/get-by-role/{id?}', [PermissionController::class, 'getByRole']);
        Route::put('/change-permission', [PermissionController::class, 'changePermission'])->name('change-permission');
        Route::post('/add', [PermissionController::class, 'add'])->name('permission.add');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->middleware('permission');
        Route::post('/add', [UsersController::class, 'addUser'])->name('users.add');
        Route::post('/delete', [UsersController::class, 'deleteUser'])->name('users.delete');
        Route::post('/update', [UsersController::class, 'editUser'])->name('users.update');
        Route::get('/export-as-excel', [UsersImportExportController::class, 'exportAsExcel'])->name('export-users-as-excel');
    });

    Route::prefix('subscribers')->group(function () {
        Route::get('/', [NewsLetterSubscribersController::class, 'index'])->middleware('permission');
        Route::post('/add', [NewsLetterSubscribersController::class, 'addUser'])->name('subscriber.add');
        Route::post('/delete', [NewsLetterSubscribersController::class, 'delete'])->name('subscribers.delete');
        Route::post('/update', [NewsLetterSubscribersController::class, 'editUser'])->name('subscriber.update');
    });
});
