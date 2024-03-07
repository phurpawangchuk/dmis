@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Qualifications')
@section('content')
@section('heading','Qualifications')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header text-right"><a href="/Qualifications/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add QUalification</a></div>
            @include('partials.admin-message')
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped">
                    <tr>
                        <th>Name</th><th>Is Required</th><th class="text-right">Action</th>
                    </tr>
                    @foreach($getqualifications as $qualifications )
                    <tr>
                        <td>{{$qualifications->name}}</td>
                        <td>
                            @if($qualifications->is_required=='1')
                            <i class="fa fa-check"></i>                                     
                             @endif        
                        </td>
                        <td class="text-right">
                            <a href="{{route('qualifications.edit',$qualifications->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if($qualifications->profilequalification->count()==0)
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                                <a data-form="#frmDelete-{{$qualifications->id}}" data-title="Delete Document- {{$qualifications->name}}" data-message="Are you sure you want to delete this document?"></a>
                            </a>

                            <form action="{{route('qualifications.destroy',$qualifications->id)}}" method="POST" id="{{ 'frmDelete-'.$qualifications->id }}">
                                @csrf
                               
                            </form>
                            @else
                            <span class="btn btn-xs btn-dark"><i class="fa fa-ban"></i></span>
                            @endif
                        </td>
                      
                    </tr>
                    @endforeach
                </table>
                
            </div>   
        </div>
        
    </div>

   
</div>
@include('partials.confirm-delete')    
    
      
@endsection