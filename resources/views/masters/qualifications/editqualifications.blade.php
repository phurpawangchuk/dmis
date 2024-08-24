@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Edit Qualifications ')
@section('content')
@section('heading','Edit Qualifications')
<form action="{{route('qualifications.update',$qualification->id)}}" class="form-horizontal" method="Post">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-md-10">
        <div class="card card-info card-outline">
            <div class="card-body">
                
                    <div class="form">
                        <label for="inputEmail3">Quaification</label>
                            
                                <input type="text" name="name" value="{{$qualification->name}}" class="form-control" id="inputEmail3" placeholder="Document Name">
                            
                    </div>

                    
                    <div class="form">
                        <label for="inputEmail3">Required? </label>
                            
                        <div class="form-check-inline">
                                <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" value="1"<?php if($qualification->is_required==1){echo"checked";} ?>>Yes
                                </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="0"<?php if($qualification->is_required==0){echo"checked";} ?> >No
                                </label>
                        </div>

                            
                    </div>

                    
                
            </div>
        </div>
    </div> 

    <div class="col-md-10 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Update </button>
        
    </div>
</div> 
</form>
    
      
@endsection