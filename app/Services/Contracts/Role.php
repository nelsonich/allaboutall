<?php

namespace App\Services\Contracts;

use App\Models\RBAC\Role as RBACRole;

interface Role {
    public function getWithoutSuperAdmin(): iterable;
    public function getById(int $id): RBACRole;
}
