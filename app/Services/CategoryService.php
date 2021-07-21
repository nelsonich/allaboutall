<?php 

namespace App\Service;

use App\Services\Category as CategoryInterface;
use App\Models\Category;

class CategoryService implements CategoryInterface 
{
    public function get(?int $id): iterable
    {
        return Category::activeCategories($id)->get();
    }

    public function firstActive(int $id): object
    {
        return Category::where('id', $id)->where('is_active', 'true')->first();
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
}