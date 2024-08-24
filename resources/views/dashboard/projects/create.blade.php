@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{  $title }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="name" class="required col-8 col-form-span">{{ __('Project Name') }}</span>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="shortCode" class="required col-8 col-form-span">{{ __('Short Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="shortCode" required></textarea>
                </div>
            </div>

             <div class="form-group row">
                <span for="description" class="required col-8 col-form-span">{{ __('Detail Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="description" id="description" required></textarea>
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
                        {{ __('Create') }}
                    </button>

                    <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-span="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
