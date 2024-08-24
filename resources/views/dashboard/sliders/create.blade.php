@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{ __('Add New Slider Image') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.sliders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="title" class="required col-md-4 col-form-span text-md-right">{{ __('Title') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" required autocomplete="title" >
                </div>
            </div>

            <div class="form-group row">
                <span for="document_id" class="required col-md-4 col-form-span text-md-right">{{ __('Slider Image') }}</span>
                <div class="col-md-6">
                    <input type="file" class="form-control" name="file_name">
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
