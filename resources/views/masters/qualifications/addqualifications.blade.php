@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Add Qualification ')
@section('content')
@section('heading','Add Qualification')
<form action="{{route('qualifications.store')}}" class="form-horizontal" method="Post">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info card-outline">
             <div class="card-body">
                 <div class="form-group">
                    <label for="inputEmail3">Qualification</label>
                    <input type="text" name="name" class="form-control form-control-sm" id="inputEmail3" placeholder="Name" required>                  
                </div>
                <div class="form-group">
                    <label for="inputEmail3">Required</label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="1" checked>Yes
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio" value="0">No
                            </label>
                        </div>
                </div>

                                
            
        </div>
    </div>
</div>

    <div class="col-md-8 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add </button>
    </div>
</div> 

    
      
@endsection