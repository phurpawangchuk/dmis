@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{  $title }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.calendars.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="event_name" class="required col-md-4 col-form-span">{{ __('Event Name') }}</span>
                <div class="col-12">
                    <input type="text" class="form-control" name="event_name" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="description" class="required col-md-4 col-form-span">{{ __(' Description') }}</span>
                <div class="col-12">
                <textarea class="form-control" name="description" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="event_date" class="required col-md-4 col-form-span">{{ __(' Date') }}</span>
                <div class="col-12">
                    <input type="date" class="form-control" name="event_date" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-12 offset-md-4">
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
