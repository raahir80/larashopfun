<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
    	$users=User::all();
    	return view('admin.users.index',compact('users'));
    }


  
    public function active($id){

    	//Find the user

    	$user=User::find($id);


    	//update the user
    		$user->update(['status' => 1]);

    	//session message

    		session()->flash('msg','You are active');

    	//Redirect the page

    		return redirect('admin/users');
    }

    public function blocked($id){



    	$user=User::find($id);

    	$user->update(['status'=> 0]);

    	session()->flash('msg','You are blocked');


    	return redirect('admin/users');
    }

    public function show($id){
  
  		$orders=Order::where('user_id',$id)->get();
  			

  			//dd($orders);
    	//$user=User::find($id);
    	

    	//Return Array back to user details

    	return view('admin.users.details',compact('orders'));

    }

}
