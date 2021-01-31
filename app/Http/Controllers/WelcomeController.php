<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::activeCategories(null)->get();

        return view('welcome', [
            'categories' => $categories,
        ]);
    }

    public function renderParentCategoryPage($id)
    {
        $limit = 5;
        $parentCategory = Category::activeCategories(null)->where('id', $id)->first();
        $childCategories = Category::activeCategories($id)->with('categoryDetails')->limit($limit)->get();
        $dataCount = Category::activeCategories($id)->count();

        return view('parentCategoryPage', [
            'childCategories' => $childCategories,
            'parentCategory' => $parentCategory,
            'ifIssetData' => $dataCount > $limit ? 'true' : 'false',
        ]);
    }

    public function renderPageInformation($parentId, $childId)
    {
        $parentCategory = Category::activeCategories(null)->where('id', $parentId)->first();
        $childCategories = Category::activeCategories($parentId)->where('id', $childId)->with('categoryDetails', 'categoryCarouselItems')->first();

        return view('info', [
            'childCategories' => $childCategories,
            'parentCategory' => $parentCategory,
        ]);
    }

    public function getChildData(Request $request)
    {
        $id = $request->post('id');
        $offset = $request->post('offset');
        $q = $request->post('q');

        $dataCount = Category::activeCategories($id)->count();
        $childCategories = Category::activeCategories($id)->with('categoryDetails')->offset($offset)->limit(5)->get();

        if ($q != "") {
            $dataCount = dataCount($id, $q);

            $childCategories = childCategories($id, $q);
        }

        return response()->json([
            'childCategories' => $childCategories,
            'ifIssetData' => $dataCount > $offset + 5 ? 'true' : 'false',
        ]);
    }

    public function search(Request $request, $parentId, $search)
    {
        if ($search == "") return response()->json('empty input');

        $dataCount = dataCount($parentId, $search);

        $childCategories = childCategories($parentId, $search);

        return response()->json([
            'childCategories' => $childCategories,
            'ifIssetData' => $dataCount > 5 ? 'true' : 'false',
        ]);
    }

    public function addLinkCount(Request $request, $id)
    {
        $clickCount = Category::where('id', $id)->increment('click_count', 1);

        return response()->json($clickCount);
    }
}
