<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselItemModelRequest;
use App\Http\Requests\CategoryModelRequest;
use App\Models\CarouselItem;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\SearchTag;
use App\Services\CategoryService;
use App\Traits\Controllers\SettingsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    use SettingsTrait;

    private $category_repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $category_repo)
    {
        $this->category_repo = $category_repo;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.category.categories', [
            'categories' => $this->category_repo->getWithTrashed(null),
            'is_view' => isView('child_categories'),
            'is_add' => isAdd('categories'),
            'is_edit' => isEdit('categories'),
            'is_delete' => isDelete('categories'),
        ]);
    }

    public function getChildCategories($id): View
    {
        return view('dashboard.category.childCategories', [
            'category' => $this->category_repo->firstActive($id),
            'categoryChildes' => $this->category_repo->childCategoriesWithTags($id, 15),
            'is_add' => isAdd('child_categories'),
            'is_edit' => isEdit('child_categories'),
            'is_delete' => isDelete('child_categories'),
        ]);
    }

    public function createCategory(CategoryModelRequest $request)
    {
        $name = $request->post('name');
        $file = $request->file('background');

        $fileNames = SettingsTrait::uploadFiles('storage/backgrounds', $file);

        $this->category_repo->create([
            'name' => $name,
            'parent_id' => null,
            'is_active' => 'true',
            'background' => $fileNames[0],
        ]);

        return redirect()->back();
    }

    public function updateCategory(CategoryModelRequest $request)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $file = $request->file('background');

        $cat = Category::whereId($id)->withTrashed()->first();
        $data = ['name' => $name];
        
        if ($file) {
            SettingsTrait::removeFiles('storage/backgrounds', $cat->background);
            $fileNames = SettingsTrait::uploadFiles('storage/backgrounds', $file);
            $data['background'] = $fileNames[0];
        }

        $this->category_repo->update($data, $id);

        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
        // SettingsTrait::removeFiles('storage/backgrounds', $cat->background);
        return redirect()->back();
    }

    public function restoreCategory($id)
    {
        Category::whereId($id)->withTrashed()->restore();
        // SettingsTrait::removeFiles('storage/backgrounds', $cat->background);
        return redirect()->back();
    }

    public function createCategoryChild(CategoryModelRequest $request)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $preview = $request->post('preview');
        $description = $request->post('description');
        $file = $request->file('image');
        $fileName = 'noImage.png';

        if ($file) {
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('storage/category_details/images/'), $fileName);
        }

        $cat = $this->category_repo->create([
            'name' => $name,
            'parent_id' => $id,
            'is_active' => 'true',
        ]);

        CategoryDetail::create([
            'category_id' => $cat->id,
            'description' => $description,
            'preview_text' => $preview,
            'image' => $fileName,
        ]);

        SearchTag::create([
            'category_id' => $cat->id,
            'value' => $name,
        ]);

        Http::post('https://graph.facebook.com/v11.0/104349325019924/feed', [
            'message' => $preview,
            'link' => "http://info.loc/info-p/1/27", // single post url
            'access_token' => 'EAACsTrZAVqY8BAKOJaOGrc5Mbu3X1QWWD6pAm3E0BxEf66cv3Y5MC6WLnbzLFAsQoNRxVJZBD2a0pv98MQcUZA2xcetaQ7aoPpCjH7ZADlMqoRpHzAsQYnRDrZBnNNCANZAQXWa8mD8LLU8hS6eHn8pCEss6u84RBFUcAaav954y9CnDMfKpTUlo5YGgcrO3IBLJa4NcDE8AZDZD',
        ]);

        return redirect()->back();
    }

    public function updateCategoryChild(CategoryModelRequest $request)
    {
        $id = $request->post('id');
        $parentId = $request->post('parentId');
        $name = $request->post('name');
        $preview = $request->post('preview');
        $description = $request->post('description');
        $file = $request->file('image');

        $parentCat = Category::find($parentId);
        $parentCat->name = $name;
        $parentCat->save();

        $cat = CategoryDetail::find($id);

        if ($file) {
            if ($cat->image !== 'noImage.png') {
                File::delete(public_path('storage/category_details/images/' . $cat->image));
            }
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('storage/category_details/images/'), $fileName);
            $cat->image = $fileName;
        }

        $cat->preview_text = $preview;
        $cat->description = $description;
        $cat->save();

        return redirect()->back();
    }

    public function deleteCategoryChild($id)
    {
        // $cat = CategoryDetail::find($id);

        // if ($cat->image !== 'noImage.png') {
        //     File::delete(public_path('storage/category_details/images/' . $cat->image));
        // }

        Category::destroy($id);

        return redirect()->back();
    }

    public function changeActiveCategoryChild(Request $request)
    {
        $id = $request->post('id');
        $cat = Category::find($id);

        $cat->is_active === 'true' ? $cat->is_active = 'false' : $cat->is_active = 'true';
        $cat->save();

        return redirect()->back();
    }

    public function addCarouselItem(CarouselItemModelRequest $request)
    {
        $photos = $request->file('photos');

        foreach ($photos as $file) {
            $extension = $file->getClientOriginalExtension();
            $name = uniqid() . '.' . $extension;
            $file->move(public_path('storage/carousel/'), $name);

            CarouselItem::create([
                'category_id' => $request->post('id'),
                'name' => $name,
            ]);
        }

        return redirect()->back();
    }

    public function removeCarouselItem(Request $request, $id)
    {
        $data = CarouselItem::find($id);
        File::delete(public_path('storage/carousel/' . $data->name));
        $data->delete();
        return response()->json($id);
    }

    public function addSearchTags(Request $request)
    {
        $tags = $request->post('tags');
        $id = $request->post('id');
        $arr = explode(',', $tags);

        SearchTag::where('category_id', $id)->delete();

        foreach ($arr as $tag) {
            SearchTag::create([
                'category_id' => $id,
                'value' => $tag,
            ]);
        }

        return redirect()->back();
    }
}
