@extends('layouts.model')

@section('content')
<div class="container-fluid">
    <div class="modal-header">
        <h4 class="modal-title">{{ __('Verify QR Jrn received from the Bank') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-span="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.donors.update', $donor->id) }}">
            @csrf

            <div class="form-group row">
                <span for="jrn" class="required col-md-4 col-form-span text-md-right">{{ __('QR Jrn Number') }}</span>
                <div class="col-md-6">
                    <input type="jrn" class="form-control" value="{{ $donor->jrn }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <span for="payment_date" class="required col-md-4 col-form-span text-md-right">{{ __('Payment Date') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $donor->payment_date }}" readonly>
                </div>
            </div>

             <div class="form-group row">
                <span for="payment_date" class="required col-md-4 col-form-span text-md-right">{{ __('Amount') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $donor->amount }}" readonly>
                </div>
            </div>


            <div class="form-group row">
                <span for="actualamount" class="required col-md-4 col-form-span text-md-right">{{ __('Actual Amt. Received') }}</span>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $donor->amount }}" name="actualamount">
                </div>
            </div>
            
            <div class="form-group row">
                <span for="status" class="required col-md-4 col-form-span text-md-right">{{ __('Action') }}</span>
                <div class="col-md-6">
                    <select class="form-control" name="status" required>
                        <option value="1">Jrn Verified</option>

                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn bg-dark text-white">
                        {{ __('Update') }}
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
