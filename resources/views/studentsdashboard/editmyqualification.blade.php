@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'myqualification'
])
@section('title','Edit My Qualifications')
@section('content')
@section('heading','EditMy Qualifications')

  <div class="row">
      
    <div class="col-md-6">
    
        <div class="card card-outline card-primary">
            <div class="card-header text-bold">
                <i class="fa fa-edit"></i> Edit Qualification details for {{ $qualifications->qualification->name}}</div>
            <div class="card-body table-responsive">

            <form class="form" method="POST" action="{{ route('qualifications.qualificationUpdate',$qualifications->id) }}">

                @csrf
                @method('POST')
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">School</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="school_name" value="{{ $qualifications->school_name}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Year</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="year" value="{{ $qualifications->year}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Score</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="score" value="{{ $qualifications->score}}" required>
                    </div>
                </div>
    
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                    </div>
                </div>
                
            </form>

                
            </div>   
        </div>
        
    </div>

   
</div>

    
      
@endsection