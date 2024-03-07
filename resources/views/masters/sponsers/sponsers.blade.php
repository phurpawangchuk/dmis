@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Sponsors')
@section('content')
@section('heading','Sponsors')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header text-right"><a href="/Sponsers/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Sponsor</a></div>
            @include('partials.admin-message')
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped">
                    <tr>
                        <th>Name</th><th>Type</th><th>Address</th><th class="text-right">Action</th>
                    </tr>
                    @foreach($getsponsers as $sponser)
                    <tr>
                        <td>{{$sponser->name}}</td>
                        <td>{{$sponser->type}}</td>
                        <td>{{$sponser->address}}</td>
                        <td class="text-right">
                            <a href="{{route('sponsers.edit',$sponser->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if($sponser->sponserscholarship->count()==0)
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                                <a data-form="#frmDelete-{{$sponser->id}}" data-title="Delete Document- {{$sponser->name}}" data-message="Are you sure you want to delete this document?"></a>
                            </a>

                            <form action="{{route('sponsers.destroy',$sponser->id)}}" method="POST" id="{{ 'frmDelete-'.$sponser->id }}">
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