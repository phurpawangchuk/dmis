@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'mydocuments'
])
@section('title','My Documents')
@section('content')
@section('heading','My Documents')

<div class="row">
    <div class="col-md-12">
    @include('partials.admin-message')
        <div class="card card-outline card-warning">
            
            <div class="card-body table-responsive-sm p-0">

                <table class="table table-hover text-nowrap table-striped">
                    <tr>
                        <th>Sl No</th><th>Document</th><th>Document Type</th><th class="text-center">Required</th><th>File Name</th><th></th>
                    </tr>
                    @foreach($documents as $document)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$document->name}}</td>
                        <td>{{$document->type}}</td>
                        <td class="text-center">
                            @if ($document->is_required==1)
                            <span class="badge bg-danger"><i class="fa fa-check fa-xs"></i></span>
                            @endif
                        </td>

                        @if($document->profiledocument->count()>=1)

                        <td>{{ $document->profiledocument->first()->src }} 
                            @php
                                $document_link=$cid->cid.'_'.$document->id.'_'.$document->profiledocument->first()->src;
                            @endphp
                            <a href="{{ route('profile.document',$document_link) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
                        </td>
                       
                     
                        <td class="text-right"><a href="{{ route('documents.editMyDocument',$document->profiledocument->first()->id) }}" class="btn btn-xs btn-info "><i class="fa fa-edit"></i></a>
                            
                        <a href="#" class="form-confirm btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i>
                            <a data-form="#frmDelete-{{$document->id}}" data-title="Delete Document- {{$document->name}}" data-message="Are you sure you want to delete this document?"></a>
                        </a>
                            <form action="{{ route('documents.removeProfileDocument',$document->profiledocument->first()->id) }}" method="POST" id="{{ 'frmDelete-'. $document->id}}">
                                @csrf
                                
                            </form>
                        </td>
                    @else
                    <td colspan="2" class="text-center text-danger"><small>Document Not uploaded</small>
                        </td>
                    @endif
                        
                    </tr>
                    @endforeach
                    
                </table>
               
                
            </div> 
            <div class="card-footer text-right">
                @if($documentcheck>=1)
                <a href="{{ route ('documents.addProfileDocument') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Documents</a>
                @endif
            </div>  
        </div>
        
    </div>

   
</div>
@include('partials.confirm-delete') 

    
      
@endsection