<?php

use App\Models\Category;

function limit($text, $limit)
{
    return mb_strlen($text) > $limit ? mb_substr($text, 0, $limit) . "..." : $text;
}

function dataCount($id, $q)
{
    $dataCount = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
        $query->where('value', 'LIKE', '%' . $q . '%');
    })->count();

    return $dataCount;
}

function childCategories($id, $q)
{
    $childCategories = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
        $query->where('value', 'LIKE', '%' . $q . '%');
    })->with('categoryDetails')->limit(5)->get();

    return $childCategories;
}
