<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends controller
{
    public function index(){
        $superAdminRole = Role::where('name','superadmin')->first();
        $adminRole = Role::where('name','admin')->first();

        $data['admins'] = User::whereIn('role_id',[$adminRole->id, $superAdminRole->id])
        ->orderBy('id','desc')
        ->paginate(10);

        return view('admin.admins.index')->with($data);
    }

    public function create(){
        $data['roles'] = Role::select('id','name')->whereIn('name', ['admin', 'superadmin'])->get();
        return view('admin.admins.create')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:5|max:255|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
        return redirect(url("dashboard/admins"));
    }

    public function promote($id){
        $admin = User::findOrFail($id);
        $admin->update([
            'role_id' => Role::select('id')->where('name','superadmin')->first()->id
        ]);
        return back();
    }

    public function demote($id){
        $admin = User::findOrFail($id);
        $admin->update([
            'role_id' => Role::select('id')->where('name','admin')->first()->id
        ]);
        return back();
    }
}
