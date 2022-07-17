<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Role,
    RoleUser
};
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenUserController extends Controller
{
    public function index(){
        $users = User::get();
        $roles = Role::get();
        return view('pages.superadmin.manajemen-user.index', compact('users', 'roles'));
    }

    public function store(Request $request){

    }

    public function update(Request $request){
        $user = User::find($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if($request['password']) $user->password = Hash::make($request['password']);
        $user->save();
        
        RoleUser::where('users_id', $request['id'])->delete();
        RoleUser::create([
            'users_id' => (int) $request['id'],
            'roles_id' => (int) $request['role_id']
        ]);

        alert()->success('Berhasil','Berhasil edit data user');
        return redirect('/admin/manajemen-user');
    }
}
