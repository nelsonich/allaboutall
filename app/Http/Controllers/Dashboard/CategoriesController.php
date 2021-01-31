<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarouselItem;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\SearchTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::activeCategories(null)->get();

        return view('dashboard.category.categories', [
            'categories' => $categories,
        ]);
    }

    public function getChildCategories($id)
    {
        $category = Category::where('id', $id)->where('is_active', 'true')->first();
        $categoryChildes = Category::categories($id)->with('categoryDetails', 'categoryCarouselItems', 'searchTags')->paginate(15);

        foreach ($categoryChildes as $item) {
            $tags = [];
            if (count($item['searchTags']) > 0) {
                foreach ($item['searchTags'] as $tag) $tags[] = $tag['value'];
            }

            $item['tags'] = $tags;
        }

        return view('dashboard.category.childCategories', [
            'category' => $category,
            'categoryChildes' => $categoryChildes,
        ]);
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'background' => 'required'
        ]);

        $name = $request->post('name');
        $file = $request->file('background');

        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('storage/backgrounds'), $fileName);

        Category::create([
            'name' => $name,
            'parent_id' => null,
            'is_active' => 'true',
            'background' => $fileName,
        ]);

        return redirect()->back();
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $id = $request->post('id');
        $name = $request->post('name');
        $file = $request->file('background');

        $cat = Category::find($id);

        if ($file) {
            File::delete(public_path('storage/backgrounds/' . $cat->background));
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('storage/backgrounds'), $fileName);
            $cat->background = $fileName;
        }

        $cat->name = $name;
        $cat->save();

        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->post('id');
        $cat = Category::find($id);
        File::delete(public_path('storage/backgrounds/' . $cat->background));
        $cat->delete();
        return redirect()->back();
    }

    public function createCategoryChild(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

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

        $cat = Category::create([
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

        return redirect()->back();
    }

    public function updateCategoryChild(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

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

    public function deleteCategoryChild(Request $request)
    {
        $id = $request->post('id');
        $cat = CategoryDetail::find($id);

        if ($cat->image !== 'noImage.png') {
            File::delete(public_path('storage/category_details/images/' . $cat->image));
        }

        Category::destroy($cat->category_id);

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

    public function addCarouselItem(Request $request)
    {
        $request->validate([
            'photos' => 'required'
        ]);
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
