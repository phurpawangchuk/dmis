@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'myqualification'
])
@section('title','Add My Qualifications')
@section('content')
@section('heading','Add My Qualifications')
<form class="form form-horizontal" method="POST" action="{{route('qualifications.qualificationAdd')}}">
                    @csrf
                    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-body table-responsive">
                    
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Qualification</label>
                            <div class="col-sm-6">
                                <select name="qualification_id" class="form-control form-control-sm" required>
                                    <option value="">--SELECT QUALIFICATION--</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">School</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="inputEmail3" name="school_name"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Year</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="inputEmail3" name="year"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Score</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="inputEmail3" name="score"  required>
                            </div>
                        </div>
                            
                </div>   
                <div class="card-footer">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Qualification</button>
                    </div>
                </div>
                <input type="hidden" name="profile_id" value="{{ $profile_id->id}}">
            </div>  
        </div>
    </div>
    </form> 
    
      
@endsection