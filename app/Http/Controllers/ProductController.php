<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function index(){

            $products=Product::all();

        return view('admin.products.index',compact('products'));

    }


    public function create(){

        $product=new Product();
    	 return view('admin.products.create',compact('product'));
    }


    public function store(Request $request){



    	//dd($request->all());
    	//validate the form

    	$request->validate([
    		'name'=>'required',
    		'price'=>'required',
    		'description'=>'required',
    		'image'=>'image|required'
    	]);

    	//Upload the image
    	if($request->hasFile('image')){

    		$image=$request->image;
    		$image->move('uploads',$image->getClientOriginalName());

    	}


    	//save the data into database
    	Product::create([
    		'name'=>$request->name,
    		'price'=>$request->price,
    		'description'=>$request->description,
    		'image'=>$request->image->getClientOriginalName()
    	]);
    	//Session message
    	$request->session()->flash('msg','Your product has been added');

    	//Redirect

    	return redirect('products/create');
    }


    public function destroy($id){


        //return $id;
      //delete the product
        Product::destroy($id);

        // store a message
        session()->flash('msg','Product has been deleted');

        return redirect('admin/products');
    }


    public function edit($id){
//        return $id;
        $product=Product::find($id);
        return view('admin.products.edit',compact('product'));

    }


    public function update(Request $request, $id){
        //Find the product

        $product=Product::find($id);

        //Validate the form

        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        //check if there is any image
        if($request->hasFile('image')){
            if(file_exists(public_path('uploads/').$product->image)){
                unlink(public_path('uploads/').$product->image);
            }


            //upload the new image

            $image=$request->image;
            $image->move('uploads',$image->getClientOriginalName());

            $product->image=$request->image->getClientOriginalName();
        }

        //updating the product

        $product->update([

            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$product->image
        ]);

        //store a message in session
        $request->session()->flash('msg','Product has been updated');

        //Redirect

        return redirect('admin/products');
    }

    public function show($id){
        $product=Product::find($id);

        return view('admin.products.details',compact('product'));
    }

}
