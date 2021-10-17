<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionModelRequest;
use App\Models\RBAC\Permission;
use App\Models\RBAC\Role;
use App\Models\RBAC\RolePermission;
use Illuminate\Http\Request;
use App\Services\PermissionResponseService;
use App\Services\RoleService;
use Illuminate\View\View;

class PermissionController extends Controller
{
    private $permissions_repo;
    private $role_repo;

    public function __construct(
        PermissionResponseService $permissions_repo,
        RoleService $role_repo
    ){
        $this->permissions_repo = $permissions_repo;
        $this->role_repo = $role_repo;
        $this->middleware('auth');
    }

    public function index(): View
    {
        $admin = Role::where('name', Role::ADMIN)->first();

        return view('dashboard.permissions', [
            'roleId' => $admin->id,
            'roles' => $this->role_repo->getWithoutSuperAdmin(),
            'permissions' => $this->permissions_repo->get($admin->id, Permission::all()),
            'is_view' => isView('permissions'),
            'is_add' => isAdd('permissions'),
            'is_edit' => isEdit('permissions'),
            'is_delete' => isDelete('permissions'),
        ]);
    }

    public function getByRole($id): View
    {
        return view('dashboard.permissions', [
            'roleId' => $id,
            'roles' => $this->role_repo->getWithoutSuperAdmin(),
            'permissions' => $this->permissions_repo->get($id, Permission::all())
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

        return response()->noContent();
    }

    public function add(PermissionModelRequest $request)
    {
        $roles = Role::all();

        $name = $request->post('name');
        $slug = $request->post('slug');

        $permission = Permission::create([
            'name' => $name,
            'slug' => $slug,
        ]);

        foreach ($roles as $role) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
                'is_view' => $role->name === Role::SUPER_ADMIN,
                'is_add' => $role->name === Role::SUPER_ADMIN,
                'is_edit' => $role->name === Role::SUPER_ADMIN,
                'is_delete' => $role->name === Role::SUPER_ADMIN,
            ]);
        }

        return redirect()->back();
    }
}