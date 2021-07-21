<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $role_repo;

    public function __construct(RoleService $role_repo)
    {
        $this->role_repo = $role_repo;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->with('role')->paginate(15);

        return view('dashboard.users', [
            'users' => $users,
            'roles' => $this->role_repo->getWithoutSuperAdmin(),
            'is_add' => isAdd('users'),
            'is_edit' => isEdit('users'),
            'is_delete' => isDelete('users'),
        ]);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

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

        return redirect()->back();
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

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
