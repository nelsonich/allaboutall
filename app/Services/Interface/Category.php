<?php

namespace App\Services;

interface Category {
    public function get(?int $id): iterable;
    public function firstActive(int $id): object;
    public function childCategoriesWithTags(int $id, int $limit): iterable;
}