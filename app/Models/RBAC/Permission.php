<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name', 'slug', 'parent_id'];

    const RULES = [
        'name' => 'required',
        'slug' => 'required',
    ];
}
