<?php

namespace App\Services;

use App\Services\Contracts\User as UserInterface;
use App\Models\RBAC\Role;
use App\User;

class UserService implements UserInterface
{
    public function getWithoutSuperAdmin(int $limit = 15): iterable
    {
        $superAdmin = Role::where('name', Role::SUPER_ADMIN)->first();
        return User::where('role_id', '!=', $superAdmin->id)->paginate($limit);
    }

    public function getById(int $id): User
    {   
        return User::whereId($id)->with('role')->first();
    }
}
