@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{  $title }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.countries.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="countryName" class="required col-md-4 col-form-span text-md-right">{{ __('Country Name') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="countryName" value="" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="countryCode" class="required col-md-4 col-form-span text-md-right">{{ __('Country Code') }}</span>
                <div class="col-md-6">
                <input type="text" class="form-control" name="countryCode" value="" required>
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
