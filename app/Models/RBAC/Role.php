<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER_ADMIN = "super_admin";
    const ADMIN = "admin";
    const MODERATOR = "moderator";
    const WRITER = "writer";

    protected $table = "roles";
    protected $fillable = ['name', 'description'];
}
