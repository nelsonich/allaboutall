<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchTag extends Model
{
    protected $table = "search_tags";
    protected $fillable = [
        'category_id',
        'value',
    ];
}
