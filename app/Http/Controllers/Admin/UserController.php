<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDataDiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view_users'])->only('index');
        $this->middleware(['permission:add_users'])->only('store');
        $this->middleware(['permission:edit_users'])->only('update');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.users.index', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'min:8|confirmed|required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            UserDataDiri::create([
                'user_id' => $user->id
            ]);

            $user->syncRoles($request->input('role_id'));

            DB::commit();
            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.user.index')
                ->with('errors', 'User gagal ditambahkan.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $id . '|max:255',
            'password' => 'min:8|confirmed|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.index')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (isset($request->password)) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        $user->syncRoles($request->input('role_id'));

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
