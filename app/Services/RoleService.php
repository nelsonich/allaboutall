<?php

namespace App\Services;

use App\Services\Contracts\Role as RoleInterface;
use App\Models\RBAC\Role;

class RoleService implements RoleInterface
{
    public function getWithoutSuperAdmin(): iterable
    {
        return Role::where('name', '!=', Role::SUPER_ADMIN)->get();
    }

    public function getById(int $id): Role
    {
        return Role::find($id);
    }
}
