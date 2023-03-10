<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "categories";

    protected $fillable = [
        'user_id',
        'click_count',
        'name',
        'parent_id',
        'is_active',
        'background',
    ];

    const RULES = [
        'name' => 'required',
    ];

    public function categoryDetails()
    {
        return $this->hasOne(CategoryDetail::class, 'category_id');
    }

    public function categoryCarouselItems()
    {
        return $this->hasMany(CarouselItem::class, 'category_id');
    }

    public function searchTags()
    {
        return $this->hasMany(SearchTag::class, 'category_id');
    }

    static function activeCategories($id)
    {
        return self::where('is_active', 'true')->where('parent_id', $id)->orderByDesc('created_at');
    }

    static function categories($id)
    {
        return self::where('parent_id', $id)->orderByDesc('created_at');
    }

    public function parent_category()
    {
        return $this->hasOne(Category::class, "id", "parent_id");
    }
}
