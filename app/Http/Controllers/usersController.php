<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class usersController extends Controller
{
    public function index()
    {
        $data['users'] = User::paginate(15);
        return view('theme.users',$data);
    }

    public function create()
    {
        return view('theme.user-create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        \Session::flash('status', 'تم أضافة المستخدم بنجاح');

        return back();
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('theme.user-edit',$data);
    }

    public function update(Request $request,$id)
    {
        $changPass = $request->input('change-password');

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($changPass == 'on') {
            $user->password = Hash::make($request->input('password'));
        }

        if(Auth::user()->id != $user->id) {
            $user->role = $request->input('role');
        }

        $user->save();

        

        \Session::flash('status', 'تم تحديث بيانات المستخدم بنجاح');

        return back();
    }

    public function delete($id)
    {
        User::destroy($id);

        \Session::flash('status', 'تم حذف بيانات المستخدم بنجاح');

        return back();
    }
}
