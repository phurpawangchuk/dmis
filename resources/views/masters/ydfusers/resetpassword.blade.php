@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Reset Password ')
@section('content')
@section('heading','Reset Password')
<form action="{{route('manageusers.passwordupdate',$getuser->id)}}" class="form-horizontal" method="Post">
                @csrf
                @method('POST')
<div class="row">
    <div class="col-md-7">
        <div class="card card-info card-outline">
            <div class="card-body">
            @include('partials.admin-message')
               
                    <div class="form-group">
                        <label for="inputEmail3" >Password #</label>
                            
                            
                                <input type="password" name="pw1" class="form-control{{ $errors->has('pw1') ? ' is-invalid' : '' }}"  id="inputEmail3" placeholder="Password">
                                @error('pw1')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" >Conform Password</label>
                            
                                <input type="password" name="pw2" class="form-control{{ $errors->has('pw2') ? ' is-invalid' : '' }}"  id="inputEmail3" placeholder="Conform Password">
                                @error('pw2')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror

                            </div>
                                   
                    

                    
                
            </div>
        </div>
    </div> 

    <div class="col-md-7 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Change </button>
        
    </div>
</div> 
</form>

      
@endsection