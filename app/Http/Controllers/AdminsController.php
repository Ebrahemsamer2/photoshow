<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\User;

class AdminsController extends Controller
{

    public function index()
    {
        $admins = User::orderBy('id', 'desc')->paginate(10);
        return view('admins.index', compact('admins'));
    }

    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $inputs = $request->all();

        $admin->update($inputs);
        Session::flash('admin_updated', 'Admin has Updated');
        return redirect('/admins');
    }

    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('admin_deleted', 'Admin has deleted');
        return redirect('/admins');
    }

    public function approve(Request $request) {

        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        if($user->admin == 1) {
            $user->update(['admin' => 0]);
            Session::flash('admin_approve', 'Admin has dis-approved');
        }else {
            Session::flash('admin_approve', 'Admin has approved');
            $user->update(['admin' => 1]);
        }
        return redirecT('/admins');
    }
}
