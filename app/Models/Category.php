<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'click_count',
        'name',
        'parent_id',
        'is_active',
        'background',
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
}
