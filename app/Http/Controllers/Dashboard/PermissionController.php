<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RBAC\Permission;
use App\Models\RBAC\Role;
use App\Models\RBAC\RolePermission;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $admin = Role::where('name', Role::ADMIN)->first();
        $roles = Role::where('name', '!=', Role::SUPER_ADMIN)->get();
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $permission['actions'] = RolePermission::where('role_id', $admin->id)->where('permission_id', $permission->id)->first();
        }

        return view('dashboard.permissions', [
            'roleId' => $admin->id,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function getByRole(Request $request, $id)
    {
        $roles = Role::where('name', '!=', Role::SUPER_ADMIN)->get();
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $permission['actions'] = RolePermission::where('role_id', $id)->where('permission_id', $permission->id)->first();
        }

        return view('dashboard.permissions', [
            'roleId' => $id,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function changePermission(Request $request)
    {
        $bool = $request->post('bool');
        $permissionId = $request->post('permission_id');
        $roleId = $request->post('role_id');
        $action = $request->post('action');

        $rolePermission = RolePermission::where('role_id', $roleId)->where('permission_id', $permissionId)->first();
        $rolePermission[$action] = $bool == 'true';
        $rolePermission->save();
        $rolePermission->refresh();

        return response()->json('ok');
    }
}
