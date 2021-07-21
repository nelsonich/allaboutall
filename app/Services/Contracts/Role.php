<?php

namespace App\Services\Contracts;

interface Role {
    public function getWithoutSuperAdmin(): iterable;
}
