<?php

use App\User;
use App\Models\Category;
use App\Models\RBAC\Permission;
use App\Models\RBAC\Role;
use App\Models\RBAC\RolePermission;

if (! function_exists('limit')) {
    function limit($text, $limit)
    {
        return mb_strlen($text) > $limit ? mb_substr($text, 0, $limit) . "..." : $text;
    }
}


if (! function_exists('dataCount')) {
    function dataCount($id, $q)
    {
        $dataCount = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
            $query->where('value', 'LIKE', '%' . $q . '%');
        })->count();

        return $dataCount;
    }
}

if (! function_exists('childCategories')) {
    function childCategories($id, $q)
    {
        $childCategories = Category::activeCategories($id)->whereHas('searchTags', function ($query) use ($q) {
            $query->where('value', 'LIKE', '%' . $q . '%');
        })->with('categoryDetails')->limit(5)->get();

        return $childCategories;
    }
}

if (! function_exists('isView')) {
    function isView($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $auth = User::whereId(auth()->id())->with('role')->first();

        $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

        return $rolePermission->is_view;
    }
}

if (! function_exists('isAdd')) {
    function isAdd($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $auth = User::whereId(auth()->id())->with('role')->first();

        $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

        return $rolePermission->is_add;
    }
}

if (! function_exists('isEdit')) {
    function isEdit($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $auth = User::whereId(auth()->id())->with('role')->first();

        $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

        return $rolePermission->is_edit;
    }
}

if (! function_exists('isDelete')) {
    function isDelete($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $auth = User::whereId(auth()->id())->with('role')->first();

        $rolePermission = RolePermission::where('permission_id', $permission->id)->where('role_id', $auth->role->id)->first();

        return $rolePermission->is_delete;
    }
}

if (! function_exists('chacke_auth_user_role')) {
    function chacke_auth_user_role($role)
    {
        $role_id = Role::where('name', $role)->first()->id;
        $auth_role_id = User::whereId(auth()->id())->first()->role_id;

        return $auth_role_id === $role_id;
    }
}