@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Edit Users ')
@section('content')
@section('heading','Edit Users')
<form action="{{route('manageusers.update',$getuser->id)}}" class="form-horizontal" method="Post">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-7">
        <div class="card card-info card-outline">
            <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail3">Full Name</label>
                            
                                <input type="text" name="name" value="{{$getuser->name}}" class="form-control" id="inputEmail3" placeholder="Document Name">
                            
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3">Enail Address</label>
                            
                                <input type="email" name="email" value="{{$getuser->email}}" class="form-control" id="inputEmail3" placeholder="Document Name">
                            
                    </div>

                    

                    <div class="form-group">
                        <label for="inputEmail3">Status</label>
                            
                            <div class="form-check-inline">
                                  <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" value="1"<?php if($getuser->is_active==1){echo"checked";} ?>>Active
                                        </label>
                                </div>
                                <div class="form-check-inline">
                            <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="0"<?php if($getuser->is_active==0){echo"checked";} ?> >In active
                                </label>
                            </div>

                            
                    </div>

                    
                
            </div>
        </div>
    </div> 

    <div class="col-md-7 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Update </button>
        
    </div>
</div> 
</form>

    
      
@endsection