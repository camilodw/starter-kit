<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $role = Role::create(['name' => 'admin']);
//        $permission = Permission::create(['name' => 'create user']);
//        $permission = Permission::create(['name' => 'show user']);
//        $permission = Permission::create(['name' => 'delete user']);
//        $permission = Permission::create(['name' => 'update user']);

//        $role = Role::find(1);
//        $permissions = Permission::get();
//        $role->syncPermissions($permissions);
        return view('home');
    }
}
