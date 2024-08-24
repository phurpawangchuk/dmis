@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Edit Sponsors ')
@section('content')
@section('heading','Edit Sponsors')
<form action="{{route('sponsers.update',$getsponser->id)}}" class="form-horizontal" method="Post">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-7">
        <div class="card card-info card-outline">
            <div class="card-body">
                
                    <div class="form-group ">
                        <label for="inputEmail3" >Name #</label>
                        <input type="text" name="name" value="{{$getsponser->name}}" class="form-control form-control-sm" id="inputEmail3" placeholder="" required>
                            
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3" >Type</label>
                            
                        <select class="form-control form-control-sm" name="type" required>
                            <option>{{$getsponser->type}}</option>
                            @foreach (config('setting.sponser_type') as $key => $value)
                            <option value="{{$value}}">{{$value}}</option>
                            
                            @endforeach
                        </select>
                            
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3" >Address#</label>
                        <input type="text" name="address" value="{{$getsponser->address}}" class="form-control form-control-sm" id="inputEmail3" placeholder="">
                           
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