@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Add Sponsors ')
@section('content')
@section('heading','Add Sponsors')
<form action="{{route('sponsers.store')}}" class="form-horizontal" method="Post">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-md-7">
        <div class="card card-info card-outline">
            <div class="card-body">
                
                    <div class="form-group ">
                        <label for="inputEmail3">Sponsor Name</label>
                            
                                <input type="text" name="name" class="form-control form-control-sm"  id="inputEmail3" placeholder="Name" required>
                               

                            
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3">Sponsor Type</label>
                            
                            <select class="form-control form-control-sm" name="type" required>
                                    <option value="">Select option</option>
                                    

                                    @foreach (config('setting.sponser_type') as $key => $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                    
                                    @endforeach
                                </select>
                                   
                            
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3">Address</label>
                            
                                <input type="text" name="address" class="form-control form-control-sm"  id="inputEmail3" placeholder="Address">
                      
                            
                    </div>

                    
                    

                    
                
            </div>
        </div>
    </div> 

    <div class="col-md-7 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Submit </button>
        
    </div>
</div> 
</form>

    
      
@endsection