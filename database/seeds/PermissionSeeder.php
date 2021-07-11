<?php

use App\Models\RBAC\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Пользователи',
            'slug' => 'users',
        ]);

        $category = Permission::create([
            'name' => 'Категории',
            'slug' => 'categories',
        ]);

        Permission::create([
            'name' => 'Дочерние Категории',
            'slug' => 'child_categories',
            'parent_id' => $category->id,
        ]);

        Permission::create([
            'name' => 'Разрешения',
            'slug' => 'permissions',
        ]);
    }
}
