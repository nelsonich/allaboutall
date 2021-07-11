<?php

use App\Models\RBAC\Permission;
use App\Models\RBAC\Role;
use App\Models\RBAC\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id,
                    'is_view' => $role->name === Role::SUPER_ADMIN,
                    'is_add' => $role->name === Role::SUPER_ADMIN,
                    'is_edit' => $role->name === Role::SUPER_ADMIN,
                    'is_delete' => $role->name === Role::SUPER_ADMIN,
                ]);
            }
        }
    }
}
