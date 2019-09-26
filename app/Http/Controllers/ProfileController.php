<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\User;

class ProfileController extends Controller
{
    public function profile($name) {
    	if(Auth::check()) {
    		
    		$user = User::where('name', $name)->get()->first();
	    	$curUserName = Auth()->user()->name;

	    	if($user) {

	    		if($user->name === $curUserName) {
	    			return view('profile', compact('user'));
	    		}else {
	    			abort(404);
	    		}
	    	}else {
	    		abort(404);
	    	}
    	}else {
    		return redirect('/login');
    	}
    }

    public function updateProfile(Request $request, $name) {
    	$admin = User::where('name', $name)->get()->first();

        $rules = [
            'name' => 'required|min:6|max:20',
            'email' => 'required',
        ];

        if($request->has('name')) {
            $admin->name = $request->name;
        }
        if($request->has('email')) {
            $admin->email = $request->email;
        }

        if(strlen($request->password) > 6 && strlen($request->confirmpassword) > 6) {
            $password = $request->password;
            $confirmpassword = $request->confirmpassword;
            if(strlen($password) >= 6) {
                if($password === $confirmpassword) {
                    $admin->password = password_hash($request->password, PASSWORD_DEFAULT);
                }else {
                    Session::flash('fail_update', 'Confirm Your Password Correctly');
                    return redirect('/profile/' . $name .' ');
                }
            }else {
                Session::flash('fail_update', 'Password is too short ( must be >= 6 )');
                return redirect('/profile/' . $name);
            }
        }
        if($admin->isClean()) {
        	Session::flash('nothing_changed', 'Your profile has not changed');
        	return redirect('/profile/' . $name );
        }else {
        	$admin->save();
        	Session::flash('updated', 'Your profile has updated');
        	return redirect('/profile/' . $admin->name );
    	}
    }
}
