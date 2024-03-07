@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Add Institute ')
@section('content')
@section('heading','Add Institute')
<form action="{{route('institutes.store')}}" class="form-horizontal" method="Post">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail3">Institute Name</label>
                            
                                <input type="text" name="name" class="form-control form-control-sm" id="inputEmail3" placeholder=" Name" required>
                               
                            
                                
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3">Location </label>
                            
                                <input type="text" name="location" class="form-control form-control-sm" id="inputEmail3" placeholder="Location" required>
                               
                            
                                
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3">Country</label>
                            
                            <select class="form-control form-control-sm" name="country" required>
                                    <option value="">Select Country</option>
                                    @foreach ($getcountry as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    
                                    @endforeach
                                </select>
                               
                            
                    </div>   
                
            </div>
        </div>
    </div> 

    <div class="col-md-8 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Submit</button>
        
    </div>
</div> 
</form>

    
      
@endsection