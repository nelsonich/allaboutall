<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\MakeNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserModelRequest;
use App\Services\RoleService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $role_repo;
    private $user_repo;

    public function __construct(RoleService $role_repo, UserService $user_repo)
    {
        $this->role_repo = $role_repo;
        $this->user_repo = $user_repo;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.users', [
            'users' => $this->user_repo->getWithoutSuperAdmin(15),
            'roles' => $this->role_repo->getWithoutSuperAdmin(),
            'is_add' => isAdd('users'),
            'is_edit' => isEdit('users'),
            'is_delete' => isDelete('users'),
        ]);
    }

    public function addUser(UserModelRequest $request)
    {
        $name = $request->post('name');
        $email = $request->post('email');
        $password = $request->post('password');
        $role = $request->post('role');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => $role,
        ]);

        MakeNewUser::dispatch([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $this->role_repo->getById($role),
        ]);

        return redirect()->back();
    }

    public function editUser(UserModelRequest $request)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $email = $request->post('email');
        $role = $request->post('role');

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->role_id = $role;
        $user->save();

        return redirect()->back();
    }

    public function deleteUser(Request $request)
    {
        $id = $request->post('id');
        User::destroy($id);

        return redirect()->back();
    }
}
