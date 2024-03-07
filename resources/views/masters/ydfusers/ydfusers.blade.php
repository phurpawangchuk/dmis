@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'mydocuments'
])
@section('title','Users')
@section('content')
@section('heading','Users')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header text-right"><a href="/Manageusers/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Users</a></div>
            @include('partials.admin-message')
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped">
                    <tr>
                        <th>Name</th><th>Email</th><th>Status</th><th class="text-right">Action</th>
                    </tr>
                    @foreach($getmanageusers as $manageuser )
                    <tr>
                        <td>{{$manageuser->name}}</td>
                        <td>{{$manageuser->email}}</td>
                        <td>
                            @if($manageuser->is_active=='1')
                              <i class="fa fa-check"></i>
                            @endif 
                                
                        </td>
                        <td class="text-right">
                           <a href="{{route('manageusers.edit',$manageuser->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                          
                            <a href="{{route('manageusers.resetpassword',$manageuser->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-key"></i>
                            </a>

                           
                           
                        </td>
                       
                    </tr>
                    @endforeach
                </table>
                
            </div>   
        </div>
        
    </div>

   
</div>

    
      
@endsection