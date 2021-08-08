<?php

namespace App\Http\Controllers;

use App\Models\RBAC\Permission;
use App\Services\PermissionResponseService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $user_repo = null;
    private $permission_repo = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $user_repo, PermissionResponseService $permission_repo)
    {
        $this->user_repo = $user_repo;
        $this->permission_repo = $permission_repo;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $array = Permission::where('parent_id', null)->get();

        return view('home', [
            "user" => $this->user_repo->getById(\auth()->id()),
            'permissions' => $this->permission_repo
                                ->get($this->user_repo->getById(\auth()->id())->role->id, $array),
        ]);
    }
}
