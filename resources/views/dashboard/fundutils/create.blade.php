@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{  $title }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.fundutils.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <span for="donor_id" class="required col-8 col-form-span">{{ __('Donor Name') }}</span>
                <div class="col-md-12">
                    <select id="donor_id" class="form-control" name="donor_id" required>
                        <option value="">Select Donor</option>
                        @foreach ($donorUsers as $d)
                        <option value="{{ $d->id }}">{{$d->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group row">
                <span for="name" class="required col-8 col-form-span">{{ __('Project Name') }}</span>
                <div class="col-md-12">
                    <select id="project_id" class="form-control" name="project_id" required>
                        <option value="">Select Project</option>
                        @foreach ($projects as $pro)
                            <option value="{{ $pro->id }}">{{$pro->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group row">
                <span for="amount_collected" class="required col-8 col-form-span">{{ __('Total Amount Collected') }}</span>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Provide amount collected" name="amount_collected" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="amount_used" class="required col-8 col-form-span">{{ __('Total Amount Used') }}</span>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Provide amount used" name="amount_used" required>
                </div>
            </div>


            <div class="form-group row">
                <span for="shortCode" class="required col-8 col-form-span">{{ __('Short Description') }}</span>
                <div class="col-md-12">
                <textarea class="form-control" name="shortCode" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="file" class="required col-8 col-form-span">{{ __('Upload Project Utilization Report') }}</span>
                <div class="col-md-12">
                <input type="file" class="form-control" name="file" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
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
