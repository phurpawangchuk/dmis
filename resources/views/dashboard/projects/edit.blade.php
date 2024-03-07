@extends('layouts.model')

@section('content')
<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title">{{ __('Edit Project') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.projects.update', $project->id) }}" enctype="multipart/form-data">
            @csrf
             <div class="form-group row">
                <span for="name" class="required col-8 col-form-span">{{ __('Project Name') }}</span>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="name" value="{{ old('name', $project->name) }}" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="shortCode" class="required col-8 col-form-span">{{ __('Short Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="shortCode" required>{{ $project->shortCode}}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="description" class="required col-8 col-form-span">{{ __('Detail Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="description" id="description" required>{{ $project->description}}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="file" class="required col-8 col-form-span">{{ __('Upload Project Report') }}</span>
                <div class="col-md-12">
                <input type="file" class="form-control" name="file" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>

                    <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> 

@endsection
