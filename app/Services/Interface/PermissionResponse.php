<?php

namespace App\Services;

interface PermissionResponse
{
    public function get(int $roleId, iterable $permissions): iterable;
}