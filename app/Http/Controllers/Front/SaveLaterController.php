<?php

namespace App\Http\Controllers\Front;


use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveLaterController extends Controller
{
    

    public function destroy($id){
    	
    	Cart::instance('saveforlater')->remove($id);
    	return redirect()->back()->with('msg','Item has been removed from save for later');
    }




    public function moveToCart($id){
    	

    	//dd($id);
    	$item=Cart::instance('saveforlater')->get($id);

    	Cart::instance('saveforlater')->remove($id);

    	$dubl=Cart::instance('saveforlater')->search(function($cartItem,$rowId) use ($id){

    		return $cartItem->id==$id;	

    	});


    	if($dubl->isNotEmpty()){
    		return redirect()->back()->with('msg','Item is save for later');
    	}

    	Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate('App\product');

    	return redirect()->back()->with('msg','Item has been moved to cart');
    }
}
