@extends('admin.layouts.master')

@section('page')
	Edit Product
@endsection
@section('content')

 			<div class="row">
                    <div class="col-lg-10 col-md-10">

                    	@include('admin.layouts.message')
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Product</h4>
                            </div>

                         <!--   @if( $errors->any() )
                            	<ul>
                            	@foreach($errors->all() as $error)
                            	<li>{{ $error }}</li>
                            	</ul>
                            	@endforeach
                            @endif
							-->

                            <div class="content">
                                {!! Form::open(['url' => ['admin/products',$product->id],'files'=>'true','method'=>'put']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                        	@include('admin.products._fields')                                   

                                   
                                    <div class="form-group">

                                    	{{ Form::submit('Update Product',['class'=>'btn btn-primary']) }}
                                        <!--button type="submit" class="btn btn-info btn-fill btn-wd">Add Product</button-->
                                    </div>


                                </div>
                                    </div>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
@endsection