<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\StoreRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:create user|show user|edit user|delete user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }
    public function index(Request $request) {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create() {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(StoreRequest $request) {
        $input = $request->only('password', 'email', 'confirm-password', 'roles', 'name');
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    public function show(User $user) {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user) {
        $roles      = Role::pluck('name', 'name')->all();
        $userRole   = $user->roles->pluck('name', 'name')->all();

        return view('dashboard.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $id,
            'password'  => 'same:confirm-password',
            'roles'     => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        $notification = array(
            'message'       => 'Se actualizó los datos correctamente',
            'alert-type'    => 'success',
        );
        return redirect()->route('users.index')->with($notification);

    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }

    public function changePassword(){
        return view('auth.change-password');
    }
    public function updatePassword(Request $request){
        $password   = Auth::user()->password;
        $oldpass    = $request->oldpass;
        $newpass    = $request->password;
        $confirm    = $request->password_confirmation;
        if (Hash::check($oldpass,$password)) {
            if ($newpass === $confirm) {
                $user = User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
                Auth::logout();
                $notification=array(
                    'message'=>'Password Changed Successfully ! Now Login with Your New Password',
                    'alert-type'=>'success'
                );
                return redirect()->route('login')->with($notification);
            }else{
                $notification=array(
                    'message'=>'New password and Confirm Password not matched!',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification=array(
                'message'=>'Old Password not matched!',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
