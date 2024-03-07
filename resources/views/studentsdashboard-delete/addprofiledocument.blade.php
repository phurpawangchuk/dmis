@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'mydocument'
])
@section('title','Add My Documents')
@section('content')
@section('heading','Add My Documents')
<form class="form form-horizontal" method="POST" action="{{ route('documents.documentAdd') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-body table-responsive">
                    
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Documents</label>
                            <div class="col-sm-6">
                                <select name="document_id" class="form-control form-control-sm" required>
                                    <option value="">--SELECT DOCUMENTS--</option>
                                    @foreach ($documents as $document)
                                        <option value="{{$document->id}}">{{$document->name}} ( {{$document->type}} )</option>
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                            <input type="file" class="form-control btn btn-dark btn-sm" name="document_path" 
                            accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpg,image/png,image/jpeg,image/gif" required>
                            </div>
                        </div>
                        
                            
                </div>   
                <div class="card-footer">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Document</button>
                    </div>
                </div>
                <input type="hidden" name="profile_id" value="{{ $profile_id->id}}">
            </div>  
        </div>
    </div>
    </form> 
    
      
@endsection