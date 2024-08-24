@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Edit Documents ')
@section('content')
@section('heading','Edit Documents')
<form action="{{route('documents.update',$getdocument->id)}}" class="form-horizontal" method="Post">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" >Document Name</label>
                    <input type="text" name="dname" value="{{$getdocument->name}}" class="form-control form-control-sm" id="inputEmail3" placeholder="Document Name">
                </div>

                <div class="form-group">
                    <label for="inputEmail3" >Document Type</label>                 
                        <select class="form-control formcontrol-sm" name="dtype">
                            <option>{{$getdocument->type}}</option>
                            @foreach (config('setting.document_type') as $key => $value)
                            <option value="{{$value}}">{{$value}}</option>
                            
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" >Required? </label>
                                        
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="1"<?php if($getdocument->is_required==1){echo"checked";} ?>>Yes
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="0"<?php if($getdocument->is_required==0){echo"checked";} ?> >No
                                </label>
                            </div>

                                        
                </div>

                                
                           
            </div>
        </div>
    </div> 

    <div class="col-md-10 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Update </button>
        
    </div>
</div>
</form> 

    
      
@endsection