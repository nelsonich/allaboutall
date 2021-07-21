<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PermissionResponseService;
use App\Services\CategoryService;
use App\Services\RoleService;
use App\Services\Contracts\PermissionResponse;
use App\Services\Contracts\Role;
use App\Services\Contracts\Category;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Role::class, RoleService::class);
        $this->app->bind(Category::class, CategoryService::class);
        $this->app->bind(PermissionResponse::class, PermissionResponseService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
