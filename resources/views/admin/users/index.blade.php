@extends('admin.layouts.master')

@section('page')

Users
@endsection

@section('content')

<div class="row">

                    <div class="col-md-12">
                    	@include('admin.layouts.message')
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users</h4>
                                <p class="category">List of all registered users</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registered at</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    	@foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                         <td>
		                                    @if ($user->status)
		                                        <span class="label label-success">Active</span>
		                                    @else
		                                        <span class="label label-warning">Blocked</span>
		                                    @endif
                             		   </td>
                                        <td>
		                                    @if ($user->status)
		                                    
		                                    	{{ link_to_route('user.blocked','Blocked', $user->id, ['class'=>'btn btn-warning btn-sm']) }}
		                                	
		                                	@else
		                                    
		                                    	{{ link_to_route('user.active','Active', $user->id, ['class'=>'btn btn-success btn-sm']) }}
		                                	
		                                	@endif  
                            			
                                            <!--button class="btn btn-sm btn-success ti-close" title="Block User"></button-->
                                              
                                            {{link_to_route('users.show','Details',$user->id,['class'=>'btn btn-success	btn-sm'])}}
                                         </td>
                                          <!--  <button class="btn btn-sm btn-primary ti-view-list-alt"
                                                    title="Details"></button>
                                        </td-->
                                    </tr>
                                    @endforeach
                                   
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

@endsection