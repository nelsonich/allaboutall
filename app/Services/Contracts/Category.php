<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Category {
    public function get(?int $id): iterable;
    public function getWithTrashed(?int $id): iterable;
    public function firstActive(int $id): object;
    public function childCategoriesWithTags(int $id, int $limit): iterable;
    public function create(array $data): Model;
    public function update(array $data, int $id): int;
}
