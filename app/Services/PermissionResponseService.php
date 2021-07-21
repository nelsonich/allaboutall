<?php

namespace App\Services;

use App\Models\RBAC\RolePermission;
use App\Services\PermissionResponse;

class PermissionResponseService implements PermissionResponse
{
    
    public function get(int $roleId, iterable $permissions): iterable
    {
        foreach ($permissions as $permission) {
            $permission['actions'] = RolePermission::where('role_id', $roleId)->where('permission_id', $permission->id)->first();
        }

        return $permissions;
    }



}