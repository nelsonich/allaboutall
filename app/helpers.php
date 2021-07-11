<?php

use App\Models\Category;
use App\Models\RBAC\Permission;
use App\Models\RBAC\RolePermission;
use App\User;

function limit($text, $limit)
{
    return mb_strlen($text) > $limit ? mb_substr($text, 0, $limit) . "..." : $text;
}

function dataCount($id, $q)
{
    $dataCount = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
        $query->where('value', 'LIKE', '%' . $q . '%');
    })->count();

    return $dataCount;
}

function childCategories($id, $q)
{
    $childCategories = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
        $query->where('value', 'LIKE', '%' . $q . '%');
    })->with('categoryDetails')->limit(5)->get();

    return $childCategories;
}

function isView($slug)
{
    $permission = Permission::where('slug', $slug)->first();
    $auth = User::where('id', auth()->id())->with('role')->first();

    $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

    return $rolePermission->is_view;
}

function isAdd($slug)
{
    $permission = Permission::where('slug', $slug)->first();
    $auth = User::where('id', auth()->id())->with('role')->first();

    $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

    return $rolePermission->is_add;
}

function isEdit($slug)
{
    $permission = Permission::where('slug', $slug)->first();
    $auth = User::where('id', auth()->id())->with('role')->first();

    $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

    return $rolePermission->is_edit;
}

function isDelete($slug)
{
    $permission = Permission::where('slug', $slug)->first();
    $auth = User::where('id', auth()->id())->with('role')->first();

    $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

    return $rolePermission->is_delete;
}
