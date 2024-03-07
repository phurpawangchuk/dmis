@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Add Users ')
@section('content')
@section('heading','Add Users')
<div class="row">
    <div class="col-md-7">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="{{route('manageusers.store')}}" class="form-horizontal" method="Post">
                @csrf
                @method('POST')
                    <div class="form-group">
                        <label for="inputEmail3">Name #</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control{{ $errors->has('dname') ? ' is-invalid' : '' }}"  id="inputEmail3" placeholder="Full Name">
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3">Email#</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="inputEmail3" placeholder="Email">
                                @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
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