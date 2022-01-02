<?php

namespace App\Traits\Controllers;

use App\Models\Category;

trait CategoryTrait {

    public static function getCategoriesWelcomePage(): array
    {
        // get 5 oldest child categories
        $oldestChildCategories = Category::where("is_active", 'true')
                                        ->whereNotNull("parent_id")
                                        ->limit(5)
                                        ->orderBy("created_at", "asc")
                                        ->with("categoryDetails")
                                        ->get();

        // get top 9 first news
        $firstTopChildCategories = Category::where("is_active", 'true')
                                        ->whereNotNull("parent_id")
                                        ->limit(9)
                                        ->orderByDesc("created_at")
                                        ->with("categoryDetails")
                                        ->whereHas("parent_category", function($query) {
                                            $query->whereNull('deleted_at');
                                        })
                                        ->get();

        // get top 4 first news
        $mostPopularChildCategories = Category::where("is_active", 'true')
                                        ->whereNotNull("parent_id")
                                        ->limit(4)
                                        ->orderByDesc("click_count")
                                        ->with("categoryDetails")
                                        ->whereHas("parent_category", function($query) {
                                            $query->whereNull('deleted_at');
                                        })
                                        ->get();

        return [$oldestChildCategories, $firstTopChildCategories, $mostPopularChildCategories];
    }

    /**
     * Parent category page information.
     *
     * @param int $id
     * @param int $limit
     *
     * @return array
     */

    public static function getParentCategoryPageInfo(int $id, int $limit): array
    {
        $parentCategory = Category::activeCategories(null)->where('id', $id)->first();
        $childCategories = Category::activeCategories($id)->with('categoryDetails')->limit($limit)->get();
        $dataCount = Category::activeCategories($id)->count();

        // topic news
        $topicNews = Category::activeCategories($parentCategory->id)
            ->with("categoryDetails")
            ->limit(5)
            ->get();

        return [$childCategories, $parentCategory, $topicNews, $dataCount];
    }

    /**
     * Get page information.
     *
     * @param int $parentId
     * @param int $childId
     *
     * @return array
     */

    public static function getPageInformation(int $parentId, int $childId): array
    {
        $topicNews = Category::activeCategories($parentId)
            ->where("id", "<>", $childId)
            ->with("categoryDetails")
            ->limit(10)
            ->get();

        $childCategories = Category::activeCategories($parentId)
            ->where("id", $childId)
            ->with("categoryDetails", "categoryCarouselItems", "parent_category")
            ->first();

        return [$topicNews, $childCategories];
    }
}
