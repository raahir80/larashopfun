<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index(){
    	return view('admin.login');
    }

    public function store(Request $request){

    	//dd($request->all());


    	//validate the user
    	$request->validate([
    		'email'=>'required|email',
    		'password'=>'required'
    	]);


    	//Log the user in
    	$credentials=$request->only('email','password');

    	if(! Auth::guard('admin')->attempt($credentials)){
    		return back()->withErrors([

    			'message'=>'Wrong credentials please try again'
    		]);
    	}

    	//session message
    		session()->flash('msg','You have been logged in');

    	//redirect

    		return redirect('/admin');
    }



    public function logout(){
        auth()->guard('admin')->logout();

        session()->flash('msg','You have been logged out');

        return redirect('/admin/login');
    }
}
