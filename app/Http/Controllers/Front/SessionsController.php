<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //


  public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){

    	return view('front.sessions.index');

    }

    public function store(Request $request){

    	//dd($request->all());

    	// validate the user
    	$rules=[
    		'email'=>'required|email',
    		'password'=>'required'

    	];

    	$request->validate($rules);


    	// check if exists
    	$data=request(['email','password']);
    	if(!auth()->attempt($data)){

    		return back()->withErrors([
    			'message'=>'Wrong Credentials Please try again'
    		]);

    	}

    	return redirect('/user/profile');

    }


    public function logout(){
    	auth()->logout();

    	session()->flash('msg','You have been successfully logged out');

    	return redirect('/user/login');

    }
}
