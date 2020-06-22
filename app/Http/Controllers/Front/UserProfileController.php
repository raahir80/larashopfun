<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;

class UserProfileController extends Controller
{
    //


    public function index(){

    	
    	/*$user=auth()->user()->id;
    	print_r($user);*/

    	$id=auth()->user()->id;
    	$user=User::where('id',$id)->first();


    	return view('front.profile.index',compact('user'));

    }


    public function show($id){
    	$order=Order::find($id);
    	return view('front.profile.details',compact('order'));
    }
}
