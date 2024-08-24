@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Institutes')
@section('content')
@section('heading','Institutes')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header text-right"><a href="/Institutes/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Institute</a></div>
            @include('partials.admin-message')
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped">
                    <tr>
                        <th>Institude Name</th><th>Location</th><th>Country</th><th class="text-right">Action</th>
                    </tr>
                    @foreach($getinstitutes as $institute )
                    <tr>
                        <td>{{$institute->name}}</td>
                        <td>{{$institute->location}}</td>
                        <th>{{$institute->country->name}}</th>
                        <td class="text-right">
                            <a href="{{route('institutes.edit',$institute->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                          
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                                <a data-form="#frmDelete-{{$institute->id}}" data-title="Delete Document- {{$institute->name}}" data-message="Are you sure you want to delete this document?"></a>
                            </a>

                            <form action="{{route('institutes.destroy',$institute->id)}}" method="POST" id="{{ 'frmDelete-'.$institute->id }}">
                                @csrf
                               
                            </form>
                           
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