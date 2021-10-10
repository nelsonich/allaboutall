<?php

namespace App\Services;

use App\Services\Contracts\Category as CategoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements CategoryInterface
{
    public function get(?int $id): iterable
    {
        return Category::activeCategories($id)->get();
    }

    public function getWithTrashed(?int $id): iterable
    {
        return Category::activeCategories($id)->withTrashed()->get();
    }

    public function firstActive(int $id): object
    {
        return Category::where('id', $id)->where('is_active', 'true')->withTrashed()->first();
    }

    public function childCategoriesWithTags(int $id, int $limit): iterable
    {
        $categoryChildes = Category::categories($id)->with('categoryDetails', 'categoryCarouselItems', 'searchTags')->paginate($limit);

        foreach ($categoryChildes as $item) {
            $tags = [];
            if (count($item['searchTags']) > 0) {
                foreach ($item['searchTags'] as $tag) $tags[] = $tag['value'];
            }

            $item['tags'] = $tags;
        }

        return $categoryChildes;
    }

    public function create(array $data): Model
    {
        $velue = Category::create($data);

        return $velue;
    }

    public function update(array $data, int $id): int
    {
        $collection = Category::where('id', $id)->update($data);

        return $collection;
    }
}
