@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'myqualification'
])
@section('title','My Qualifications')
@section('content')
@section('heading','My Qualifications')

  <div class="row">
    <div class="col-md-12">
    @include('partials.admin-message')
        <div class="card card-outline card-warning">
            <div class="card-body table-responsive p-0">
                <table class="table table table-hover text-nowrap table-striped">
                <thead> 
                    <tr>
                        <th>Sl No</th><th>Qualification</th><th class="text-center">Required</th><th>School</th><th>Year</th><th>Score</th><th></th>
                    </tr> 
                </thead> 
                <tbody>
                    @foreach($qualifications as $qualification)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$qualification->name}}</td>
                        <td class="text-center">
                            @if ($qualification->is_required==1)
                            <span class="badge bg-danger"><i class="fa fa-check fa-xs"></i></span>
                            @endif
                        </td>
                        @if($qualification->profilequalification->count()>=1)
                            <td>{{$qualification->profilequalification->first()->school_name}}</td>
                            <td>{{$qualification->profilequalification->first()->year}}</td>
                            <td>{{$qualification->profilequalification->first()->score}}</td>
                            <td class="text-right">
                                
                            <a href="{{ route('qualifications.editMyQualification',$qualification->profilequalification->first()->id)}}" class="btn btn-xs btn-info "><i class="fa fa-edit"></i></a>
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            <a data-form="#frmDelete-{{$qualification->id}}" data-title="Delete Qualification- {{$qualification->name}}" data-message="Are you sure you want to delete this qualification?"></a>
                            </a>
                            <form action="{{ route('qualifications.removeProfileQualification',$qualification->profilequalification->first()->id)}}" method="POST" id="{{ 'frmDelete-'. $qualification->id}}">
                                @csrf
                                
                            </form>
                            </td>
                            @else
                                <td colspan="5" class="text-center text-danger"><small>Qualification Not addaed</small>
                                    </td>
                            @endif
                        
                    </tr>
                    @endforeach
                </tbody>
                    
                </table>
               
                
            </div> 
            <div class="card-footer text-right">
                @if($qualificationcheck>=1)
                <a href="{{ route ('qualifications.addProfileQualification')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Qualification</a>
                @endif
            </div>  
        </div>
        
    </div>

   
</div>
@include('partials.confirm-delete')    
@endsection