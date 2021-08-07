<?php

namespace App\Services\Contracts;

use App\User as UserModel;

interface User {
    public function getWithoutSuperAdmin(int $limit): iterable;
    public function getById(int $id): UserModel;
}
