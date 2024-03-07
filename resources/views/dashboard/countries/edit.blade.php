@extends('layouts.model')

@section('content')
<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title">{{ __('Edit Country') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.countries.update', $country->id) }}">
            @csrf
             <div class="form-group row">
                <span for="countryName" class="required col-md-4 col-form-span text-md-right">{{ __('Country Name') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="countryName" value="{{ old('countryName', $country->countryName) }}" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="countryCode" class="required col-md-4 col-form-span text-md-right">{{ __('Country Code') }}</span>
                <div class="col-md-6">
                <input type="text" class="form-control" name="countryCode" value="{{ old('countryCode', $country->countryCode) }}" required>
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
