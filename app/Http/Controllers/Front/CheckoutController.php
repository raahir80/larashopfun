<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderItems;
use App\Order;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;


class CheckoutController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){

    	return view('front.checkout.index');
    }

    public function store(Request $request)
    {
    	try {

            Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Some Text',
                'metadata' => [
             //       'contents' => $contents,
               //     'quantity' => Cart::instance('default')->count()
                ]
            ]);

           


            //Insert into orders table
            $order=Order::create([

                    'user_id'=>auth()->user()->id,
                    'date'=>Carbon::now(),
                    'address'=>$request->address,
                    'status'=>0;

            ]);


            // Insert into order item table

                foreach ($Cart::instance('default')->content() as $item) {
                    
                    OrderItems::create([
                        'order_id'=> $order->id,
                        'product_id'=>$item->model->id,
                        'quantity'=>$item->qty,
                        'price'=>$item->price
                    ]);
                }

                 Cart::instance('default')->destroy();
                
    			return redirect()->back()->with('msg','Successfully done Thank you');
    	}
    	catch(Exception $e){

    	}
    }

}



