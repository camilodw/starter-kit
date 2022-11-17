<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\StoreRequest;
class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:create role|show role|edit role|delete role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('dashboard.roles.create', compact('permission'));
    }

    public function store(StoreRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role creado exitosamente');
    }

    public function show(Role $role)
    {
        $rolePermissions    = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('dashboard.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permission         = Permission::get();
        $rolePermissions    = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(UpdateRequest $request,Role $role)
    {
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role actualizado exitosamente');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role eliminado exitosamente');
    }
}
