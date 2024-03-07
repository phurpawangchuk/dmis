@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{ __('Add New User') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Full Name') }}</span>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name" >
                </div>
            </div>
            <div >
                 <h6 style=" text-align:center;">Enter Date of Birth</h6>
             </div>
            <div class="form-group row">


            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Day') }}</span>

                 <div class="col-md-6">

                    <select class="form-control form-control-sm" name="Date" required>
                        <option value="">--SELECT Day--</option>

                        <?php for($i=1;$i<32;$i++){ ?>
                        <option value="{{$i}}">{{$i}}</option>

                        <?php }  ?>
                    </select>
                 </div>
            </div>
            <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Month') }}</span>

                 <div class="col-md-6">
                    <select class="form-control form-control-sm" name="month" required>
                        <option value="">--SELECT Month--</option>

                        @foreach (config('setting.month') as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>

                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Year') }}</span>

                 <div class="col-md-6">

                    <select class="form-control form-control-sm" name="year" required>
                        <option value="">--SELECT Year--</option>

                        <?php for($i=date("Y");$i>1930;$i--){ ?>
                        <option value="{{$i}}">{{$i}}</option>

                        <?php }  ?>
                    </select>
                 </div>
            </div>


            <div class="form-group row">
                <span for="document_id" class="required col-md-4 col-form-span text-md-right">{{ __('Document Id') }}</span>
                <div class="col-md-6">
                    <input id="document_id" type="text" class="form-control" name="document_id" value="">
                </div>
            </div>

            <div class="form-group row">
                <span for="email" class="required col-md-4 col-form-span text-md-right">{{ __('E-Mail Address') }}</span>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <span for="contactno" class="required col-md-4 col-form-span text-md-right">{{ __('Contact No.') }}</span>
                <div class="col-md-6">
                    <input id="contactno" type="text" class="form-control" name="contactno" required autocomplete="contactno" >
                </div>
            </div>

            <div class="form-group row">
                <span for="address" class="required col-md-4 col-form-span text-md-right">{{ __('Address') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="address" required></textarea>
                </div>
            </div>

             <div class="form-group row">
                <span for="company" class="required col-md-4 col-form-span text-md-right">{{ __('Agency/Company') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="company" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="role_id" class="required col-md-4 col-form-span text-md-right">{{ __('Country') }}</span>
                <div class="col-md-6">
                    <select id="countryCode" class="form-control @error('countryCode') is-invalid @enderror" name="countryCode" required>
                        <option value="BTN" selected>Bhutan</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->countryCode }}">{{$country->countryName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <span for="role_id" class="required col-md-4 col-form-span text-md-right">{{ __('Role') }}</span>
                <div class="col-md-6">
                    <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                        <option value="" selected hidden>Please Select</option>
                        <option value="1">Admin</option>
                        <option value="2">YDF_User</option>
                        <option value="3">Donor_User</option>

                        <!-- @foreach ($roles as $id => $role)
                            <option value="{{$id}}">{{ $id}}-{{$role}}</option>
                        @endforeach -->
                    </select>
                </div>
            </div>

             <div class="form-group row">
                <span for="role_id" class="required col-md-4 col-form-span text-md-right">{{ __('Status') }}</span>
                <div class="col-md-6">
                    <select class="form-control" name="status" required>
                        <option value="1">Active</option>
                        <option value="2">InActive</option>
                    </select>
                </div>
            </div>

            <!-- <div class="form-group row">
                <span for="avatar" class="required col-md-4 col-form-span text-md-right">{{ __('Avatar [Image only]') }}</span>
                <div class="col-md-6">
                    <input type="file" id="avatar" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror
                </div>
            </div>
             -->

            <div class="form-group row">
                <span for="password" class="col-md-4 col-form-span text-md-right">{{ __('Password') }}</span>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <span for="password-confirm" class="col-md-4 col-form-span text-md-right">{{ __('Confirm Password') }}</span>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
