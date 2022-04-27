<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Email;
use App\Models\NewsLetterSubscriber;
use App\Services\CategoryService;
use App\Traits\Controllers\CategoryTrait;
use Illuminate\Http\Request;

/**
 * @group  Site API documentation
 *
 * APIs for site information
 */

class SiteController extends Controller
{
    use CategoryTrait;

    private $category_repo;

    public function __construct(CategoryService $category_repo)
    {
        $this->category_repo = $category_repo;
    }

    /**
     * @response  {
     *  "categories": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *  "firstTopNews": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *  "mostPopularNews": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *  "oldestNews": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }]
     * }
     */

    public function index()
    {
        // get 5 oldest child categories, get top 9 first news, get top 4 first news
        [$oldestChildCategories, $firstTopChildCategories, $mostPopularChildCategories] = $this->getCategoriesWelcomePage();

        return response()->json([
            "categories" => $this->category_repo->get(null),
            "firstTopNews" => $firstTopChildCategories,
            "mostPopularNews" => $mostPopularChildCategories,
            "oldestNews" => $oldestChildCategories
        ]);
    }

    /**
     * @bodyParam  id int required The id of the parent category. Example: 9
     * @bodyParam  offset int required This parameter means how many rows must be left in each query to retrieve data from the database. Example: 5
     * @bodyParam  q string With this parameter we look for the category by name and tag. Example: text
     *
     * @response  {
     *  "childCategories": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *
     *  "ifIssetData": "string"
     * }
     */

    public function getChildData(Request $request)
    {
        $id = $request->post('id');
        $offset = $request->post('offset');
        $q = $request->post('q');
        $limitCount = 5;

        $dataCount = Category::activeCategories($id)->count();
        $childCategories = Category::activeCategories($id)
            ->with('categoryDetails')
            ->offset($offset)
            ->limit($limitCount)
            ->get();

        if ($q != "") {
            $dataCount = dataCount($id, $q);

            $childCategories = childCategories($id, $q);
        }

        return response()->json([
            'childCategories' => $childCategories,
            'ifIssetData' => $dataCount > $offset + $limitCount ? 'true' : 'false',
        ]);
    }

    /**
     * @urlParam id required The ID of the category. Example: 1
     *
     * @response  {
     *  "childCategories": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *
     *  "parentCategory": {
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  },
     *
     *  "ifIssetData": "string",
     *
     *  "topic_news": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }]
     * }
     */

    public function renderParentCategoryPage($id)
    {
        $limit = 5;
        [$childCategories, $parentCategory, $topicNews, $dataCount] = $this->getParentCategoryPageInfo($id, $limit);

        return response()->json([
            'childCategories' => $childCategories,
            'parentCategory' => $parentCategory,
            'ifIssetData' => $dataCount > $limit ? 'true' : 'false',
            "topic_news" => $topicNews
        ]);
    }

    /**
     * @urlParam  id required The ID of the parent category. Example: 1
     * @urlParam  text required With this parameter we look for the category by name and tag. Example: text
     *
     * @response  {
     *  "childCategories": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }],
     *
     *  "ifIssetData": "string"
     * }
     */

    public function search($parentId, $search)
    {
        // if ($search == "") return response()->json('empty input');

        $dataCount = dataCount($parentId, $search);

        $childCategories = childCategories($parentId, $search);

        return response()->json([
            'childCategories' => $childCategories,
            'ifIssetData' => $dataCount > 5 ? 'true' : 'false',
        ]);
    }

    /**
     * @bodyParam name string required The name of the subscriber field. Example: Jon Doe
     * @bodyParam email string required The email of the subscriber field. Example: example@mail.com
     *
     * @response  {
     *  "title": "string",
     *  "message": "string"
     * }
     */

    public function subscribe(Request $request)
    {
        $name = $request->post("name");
        $email = $request->post("email");

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:news_letter_subscribers',
        ]);

        NewsLetterSubscriber::create([
            "name" => $name,
            "email" => $email,
        ]);

        return response()->json([
            "title" => "Спасибо " . $name . " за подписку.",
            "message" => "Вы будете получать новости, как вы упомянули ․ по адресу: " . $email,
        ]);
    }

    /**
     * @urlParam parent_id required The ID of the parent category. Example: 1
     * @urlParam child_id required The ID of the category. Example: 1
     *
     * @response  {
     *  "info": {
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "category_carousel_items": [{
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "name": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      }],
     *      "parent_category": {
     *          "id": "bigint",
     *          "user_id": "bigint",
     *          "click_count": "bigint",
     *          "name": "string",
     *          "parent_id": "bigint",
     *          "is_active": "string",
     *          "background": "string",
     *          "deleted_at": "timestamp",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  },
     *  "topic_news": [{
     *      "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "category_details": {
     *          "id": "bigint",
     *          "category_id": "bigint",
     *          "preview_text": "text",
     *          "description": "longtext",
     *          "image": "string",
     *          "created_at": "timestamp",
     *          "updated_at": "timestamp"
     *      },
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     *  }]
     * }
     */

    public function renderPageInformation($parentId, $childId)
    {
        // topic news
        [$topicNews, $childCategories] = $this->getPageInformation($parentId, $childId);

        return response()->json([
            "info" => $childCategories,
            "topic_news" => $topicNews
        ]);
    }

    /**
     * @urlParam id required The ID of the category. Example: 1
     * @response  {
     *  "success": "string"
     * }
     */

    public function addLinkCount($id)
    {
        Category::where('id', $id)->increment('click_count', 1);

        return response()->json([
            "success" => "ok"
        ]);
    }

    /**
     * @response  {
     * "id": "bigint",
     *      "user_id": "bigint",
     *      "click_count": "bigint",
     *      "name": "string",
     *      "parent_id": "bigint",
     *      "is_active": "string",
     *      "background": "string",
     *      "deleted_at": "timestamp",
     *      "created_at": "timestamp",
     *      "updated_at": "timestamp"
     * }
     */
    public function categories()
    {
        return response()->json($this->category_repo->get(null));
    }

    public function ping()
    {
        return response()->json("pong");
    }

    public function scrubbing(Request $request)
    {
        $req = $request->getContent();
        $data = json_decode($req);

        if (count($data->emails) > 0) {
            foreach ($data->emails as $email) {
                //
                Email::updateOrCreate(['email' => $email]);
            }
        }

        return response()->json([
            'success' => 'ok',
            'data' => $data->emails
        ]);
    }
}
