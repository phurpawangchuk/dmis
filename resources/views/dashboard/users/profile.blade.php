@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .column {
        float: left;
        padding: 10px;
    }

    .left {
        width: 25%;
    }

    .right {
        width: 75%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
        }
    }
</style>

<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title">{{ __('Update user profile') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.users.updateprofile', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="profile_id" value="{{$user->profile->id}}">

            <div class="form-group row">
                <!-- <div class="column left" style="background-color:#fff;">
                    <img src="{{ asset('uploads/photos/') }}/{{ $user->avatar }}" class="user-profile-pic">
                </div> -->

                <div class="column right" style="background-color:#fff;">

                    <div class="form-group row">
                        <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Full Name') }}</span>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required >
                        </div>
                    </div>

                    <div class="form-group row">
                        <span for="document_id" class="required col-md-4 col-form-span text-md-right">{{ __('Document Id') }}</span>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="document_id" value="{{ $user->profile->document_id }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <span for="contactno" class="required col-md-4 col-form-span text-md-right">{{ __('Contact No.') }}</span>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contactno" value="{{ $user->profile->contactno }}" required autocomplete="contactno" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <span for="email" class="required col-md-4 col-form-span text-md-right">{{ __('E-Mail Address') }}</span>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <span for="address" class="required col-md-4 col-form-span text-md-right">{{ __('Address') }}</span>
                        <div class="col-md-6">
                            <textarea class="form-control" name="address" required>{{ $user->profile->address }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span for="company" class="required col-md-4 col-form-span text-md-right">{{ __('Agency/Company') }}</span>
                        <div class="col-md-6">
                            <textarea class="form-control" name="company" required>{{ $user->profile->company }}</textarea>
                        </div>
                    </div>
                    <div >
                 <h6 style=" text-align:center;">Enter Date of Birth</h6>
             </div>
                    <div class="form-group row">
            <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Day') }}</span>
                 <div class="col-md-6">
                    <select class="form-control form-control-sm" name="Date" required>
                        <?php $date=explode("-",$user->dob)?>
                        <option value="{{$date[2]}}">{{$date[2]}}</option>

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
                        <option value="{{$date[1]}}">
                        @foreach (config('setting.month') as $key => $value)
                                   @if($key==$date[1])
                                        {{$value}}
                                   @endif

                        @endforeach

                        </option>

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
                        <option value="{{$date[0]}}">{{$date[0]}}</option>

                        <?php for($i=date("Y");$i>1930;$i--){ ?>
                        <option value="{{$i}}">{{$i}}</option>

                        <?php }  ?>
                    </select>
                 </div>
            </div>

                    <div class="form-group row">
                        <span for="aaa" class="required col-md-4 col-form-span text-md-right">Country<span><font color="red">*</font></span></span>
                        <div class="col-md-6">
                            <select id="countryCode" class="form-control" name="countryCode" required>
                                <option value="" selected hidden>Please Select</option>
                                @foreach ($countries as $country)
                                    @if($country->countryCode == $user->profile->countryCode)
                                        <option value="{{ $country->countryCode }}" selected>{{$country->countryName}}</option>
                                    @else
                                        <option value="{{ $country->countryCode }}">{{$country->countryName}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn bg-dark text-white">
                                {{ __('Update') }}
                            </button>

                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger" data-dismiss="modal" aria-span="Close">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
