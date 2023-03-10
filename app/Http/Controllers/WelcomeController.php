<?php

namespace App\Http\Controllers;

use App\Models\JobReaction;
use App\Services\CategoryService;
use App\Traits\Controllers\CategoryTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    use CategoryTrait;

    private $category_repo;

    public function __construct(CategoryService $category_repo)
    {
        $this->category_repo = $category_repo;
    }

    public function index(): View
    {
        // get 5 oldest child categories, get top 9 first news, get top 4 first news
        [$oldestChildCategories, $firstTopChildCategories, $mostPopularChildCategories] = $this->getCategoriesWelcomePage();

        return view('welcome', [
            "categories" => $this->category_repo->get(null),
            "firstTopNews" => $firstTopChildCategories,
            "mostPopularNews" => $mostPopularChildCategories,
            "oldestNews" => $oldestChildCategories
        ]);
    }

    public function renderParentCategoryPage($id): View
    {
        $limit = 5;
        [$childCategories, $parentCategory, $topicNews, $dataCount] = $this->getParentCategoryPageInfo($id, $limit);

        return view('parentCategoryPage', [
            'childCategories' => $childCategories,
            'parentCategory' => $parentCategory,
            'ifIssetData' => $dataCount > $limit ? 'true' : 'false',
            "topic_news" => $topicNews
        ]);
    }

    public function renderPageInformation($parentId, $childId): View
    {
        // topic news
        [$topicNews, $childCategories] = $this->getPageInformation($parentId, $childId);

        return view("info", [
            "info" => $childCategories,
            "topic_news" => $topicNews
        ]);
    }

    public function renderNeedWorkersPage()
    {
        return view("needWorkers");
    }

    public function applyToWork(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:job_reactions',
            'role' => 'required',
        ]);

        $name = $request->post("name");
        $email = $request->post("email");
        $role = $request->post("role");

        JobReaction::create([
            "name" => $name,
            "email" => $email,
            "role" => $role,
        ]);

        return redirect()->back()->with('message', '???????????? ???????? ?????????????? ??????????????, ???? ?????????????????????? ???????????????? ?? ????????.');
    }
}
