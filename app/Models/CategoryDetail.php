<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $table = "category_details";
    protected $fillable = [
        'category_id',
        'preview_text',
        'description',
        'image',
    ];
}
