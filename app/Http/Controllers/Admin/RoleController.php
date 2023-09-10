<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:view_roles'])->only('index');
        $this->middleware(['permission:add_roles'])->only('store');
        $this->middleware(['permission:edit_roles'])->only('update');
        $this->middleware(['permission:delete_roles'])->only('destroy');
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.role.index')
                ->withErrors($validator)
                ->withInput();
        }

        Role::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.role.index')
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}