<?php

namespace App\Http\Controllers;

use App\Classes\Roles;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;

        $className = User::class;

        $this->middleware("can:create, $className")->only(['create', 'store']);

        $this->middleware("can:show,userModel")->only('show');
    }

    public function index()
    {
        $users =  User::with('roles')->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = $this->model;

        return view('user.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $formData = $request
                        ->merge(['password' => bcrypt($request->get('password'))])
                        ->only(['name', 'email', 'password']);

        $user = $this->model->create($formData);

        $user->assignRole(Roles::ADMIN);

        return redirect(route('user.show', $user->getKey()))->with('success', 'User Created');
    }

    public function show(User $userModel)
    {
        $userModel->load('permissions');

        $permissions = Permission::get(['name', 'id']);

        return view('user.show', ['user' => $userModel, 'permissions' => $permissions]);
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $formData = $request->except('password');
        
        if($request->filled('password')) {
            $formData['password'] = bcrypt($request->get('password'));
        }

        $user->update($formData);

        return redirect(route('user.show', $user->getKey()))->with('success', 'User Updated Successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('danger', 'User Deleted');
    }
}
