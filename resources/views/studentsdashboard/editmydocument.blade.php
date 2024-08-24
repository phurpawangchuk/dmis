@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'mydocument'
])
@section('title','Edit My Document')
@section('content')
@section('heading','EditMy Document')

  <div class="row">
      
    <div class="col-md-6">
    
        <div class="card card-outline card-primary">
            <div class="card-header text-bold">
                <i class="fa fa-edit"></i> Edit Document </div>
            <div class="card-body table-responsive">

                <div class="form-group row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Document Name:</strong></td><td>{{ $document->document->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Document Type:</strong></td><td>{{ $document->document->type}}</td>
                            </tr>
                            <tr>
                                <td><strong>Uploaded file Name:</strong></td><td>{{ $document->src}}</td>
                            </tr>

                        </table>
                    </div>             
                </div>
            </div>   
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-dark">
        <form class="form" method="POST" action="{{ route('documents.documentUpdate',$document->id) }}" enctype="multipart/form-data">

            @csrf
            @method('POST')
            <div class="card-body">
            
                <input type="file" class="form-control btn btn-dark btn-sm" name="document_path" 
                accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpg,image/png,image/jpeg,image/gif" required>
                            

            </div>

            <div class="card-footer text-right">
                <button class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Update Document</button>
            </div>
        
        </form>

        </div>
    </div>

   
</div>

    
      
@endsection