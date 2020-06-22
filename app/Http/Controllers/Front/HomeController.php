<?php

namespace App\Http\Controllers\Front;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){


    	//$product=Product::inRandomOrder()->take(3)->get();

    	$products=Product::all();
    	//dd($product);
    	
    	return view('front.index',compact('products'));
    }
}
