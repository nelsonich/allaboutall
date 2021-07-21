<?php

namespace App\Services\Contracts;

interface PermissionResponse
{
    public function get(int $roleId, iterable $permissions): iterable;
}
