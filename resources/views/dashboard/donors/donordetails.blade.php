@extends('layouts.primary')

@section('content')
<div class="container-fluid">
    <div class="modal-header">
        @if($action == 'Active')
        <h4 class="modal-title">{{ __('Donor Details') }}</h4>
        <a href="{{ route('dashboard.donors.donorlist') }}" class="btn bg-dark text-white">
        <i class="nav-icon fa fa-arrow-back"></i>
            Back
        </a>
        @endif

         @if($action == 'Inactive')
        <h4 class="modal-title">{{ __('Inactive Donor Details') }}</h4>
        <a href="{{ route('dashboard.donors.inactivedonorlist') }}" class="btn bg-dark text-white">
        <i class="nav-icon fa fa-arrow-back"></i>
            Back
        </a>
        @endif
    </div>

    <div class="card-body">
            <div class="form-group row">
                <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Full Name') }}</span>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" readonly autocomplete="name" >
                </div>
            </div>

            <div class="form-group row">
                <span for="document_id" class="required col-md-4 col-form-span text-md-right">{{ __('Document Id') }}</span>
                <div class="col-md-6">
                    <input id="document_id" type="text" class="form-control" name="document_id" value="{{ old('document_id', $user->profile->document_id) }}" readonly/>
                </div>
            </div>
            <div >
                 <h6 style=" text-align:center;"> Date of Birth</h6>
             </div>
            <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Day') }}</span>
                 <div class="col-md-6">
                    <select class="form-control form-control-sm" name="Date" readonly>
                        <?php $date=explode("-",$user->dob)?>
                        <option value="{{$date[2]}}">{{$date[2]}}</option>
                    </select>
                 </div>
            </div>
            <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Month') }}</span>
                 <div class="col-md-6">
                    <select class="form-control form-control-sm" name="month" readonly>
                        <option value="{{$date[1]}}">{{$date[1]}}</option>
                    </select>
                  </div>
            </div>
            <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Year') }}</span>
                 <div class="col-md-6">
                    <select class="form-control form-control-sm" name="year" readonly>
                        <option value="{{$date[0]}}">{{$date[0]}}</option>
                    </select>
                 </div>
            </div>

            <div class="form-group row">
                <span for="contactno" class="required col-md-4 col-form-span text-md-right">{{ __('Contact No.') }}</span>
                <div class="col-md-6">
                    <input id="contactno" type="text" class="form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno', $user->profile->contactno) }}" readonly autocomplete="contactno" >
                </div>
            </div>

            <div class="form-group row">
                <span for="email" class="required col-md-4 col-form-span text-md-right">{{ __('E-Mail Address') }}</span>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" readonly autocomplete="email">
                </div>
            </div>


            <div class="form-group row">
                <span for="address" class="required col-md-4 col-form-span text-md-right">{{ __('Address') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="address" readonly>{{ $user->profile->address }}</textarea>
                </div>
            </div>

             <div class="form-group row">
                <span for="company" class="required col-md-4 col-form-span text-md-right">{{ __('Agency/Company') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="company" readonly >{{ $user->profile->company }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="status" class="required col-md-4 col-form-span text-md-right">{{ __('Status') }}</span>
                <div class="col-md-6">
                    <select class="form-control" name="status" readonly>
                        @if ($user->profile->status == 1)
                            <option value="1" selected>Active</option>
                        @elseif ($user->profile->status == 0)
                            <option value="0" selected>InActive</option>
                        @endif
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
            </div>
    </div>
</div>
@endsection

