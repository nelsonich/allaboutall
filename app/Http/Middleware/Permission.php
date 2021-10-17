<?php

namespace App\Http\Middleware;

use App\Models\RBAC\RolePermission;
use App\Models\RBAC\Permission as Per;
use App\User;
use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = $request->get('key');
        $auth = User::whereId(\auth()->id())->with('role')->first();

        $permission = Per::where('slug', $slug);

        if ($permission->exists()) {
            $rolePermission = RolePermission::where('role_id', $auth->role->id)
                                ->where('permission_id', $permission->first()->id)
                                ->first();
                                
            if ($rolePermission['is_view']) {
                return $next($request);
            }
        }

        return abort(404);
    }
}
