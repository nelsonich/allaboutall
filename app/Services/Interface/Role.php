<?php

namespace App\Services;

interface Role {
    public function getWithoutSuperAdmin(): iterable;
}