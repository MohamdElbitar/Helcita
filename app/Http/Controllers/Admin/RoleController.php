<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);

        Role::create(['name' => $request->name]);

        return redirect()->route('Admin.roles.index')->with('success', 'Role created successfully!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
    
        $permissions = $request->permissions; 
        
        $permissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();
    
        $role->update(['name' => $request->name]);
    
        $role->syncPermissions($permissions);
    
        return redirect()->route('Admin.roles.index')->with('success', 'Role updated successfully!');
    }
    

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return back()->with('success', 'Role deleted successfully!');
    }
}
