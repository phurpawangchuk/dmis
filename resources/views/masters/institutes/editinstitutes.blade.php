@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Edit Institute ')
@section('content')
@section('heading','Edit Institute')
<form action="{{route('institutes.update',$institute->id)}}" class="form-horizontal" method="Post">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-10">
        <div class="card card-info card-outline">
            <div class="card-body">
                    <div class="form-group ">
                        <label for="inputEmail3">Name #</label>
                            
                        <input type="text" name="name" value="{{$institute->name}}" class="form-control form-control-sm" id="inputEmail3" placeholder="Document Name" required>
                           
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3">Location </label>
                            
                                <input type="text" name="location" value="{{$institute->location}}" class="form-control form-control-sm" id="inputEmail3" placeholder="Document Name" required>
                           
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail3">Type</label>
                            
                            <select class="form-control form-control-sm" name="country" required>
                                    <option value="{{$institute->country->id}}">{{$institute->country->name}}</option>
                                    @foreach ($getcountry as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    
                                    @endforeach
                                </select>
                            
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