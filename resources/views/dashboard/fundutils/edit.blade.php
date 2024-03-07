@extends('layouts.model')

@section('content')
<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title">{{ __('Edit Fund Utilization') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.fundutils.update', $donorId.'-'.$projectId) }}" enctype="multipart/form-data">
            @csrf
           <input type="hidden" name="fundId" value="{{ isset($fundutil->id) ? $fundutil->id :'' }}">
            <div class="form-group row">
                <span for="amount_used" class="required col-8 col-form-span">{{ __('Total Amount Used') }}</span>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Provide amount used" name="amount_used" value="{{ isset($fundutil->amount_used) ? $fundutil->amount_used : '' }}" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="shortCode" class="required col-8 col-form-span">{{ __('Short Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="shortCode">{{ isset($fundutil->shortCode) ? $fundutil->shortCode : ''}}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="file" class="required col-8 col-form-span">{{ __('Upload Project Utilization Report') }}</span>
                <div class="col-md-12">
                <input type="file" class="form-control" name="file">
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
