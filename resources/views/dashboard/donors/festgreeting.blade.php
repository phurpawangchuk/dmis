@extends('layouts.primary')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{ __('Select Nationality from the list to send greeting') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.donors.send') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <span for="nationality" class="required col-form-span">{{ __('Nationality') }}</span>
                <div class="col-md-6">
                    <select name="nationality[]" id="nationality" class="form-control"  multiple required>
                        @foreach ($nationalities as $item)
                            <option value="{{ $item->country }}">
                            {{ $item->countryName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <span for="message" class="required ml-3 col-form-span">{{ __('Message') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="message" cols="15" rows="5" required></textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn bg-dark text-white">
                        {{ __('Send') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
