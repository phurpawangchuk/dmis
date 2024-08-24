@extends('layouts.model')

@section('content')
<div class="container-fluid">
    <div class="modal-header">
        <h4 class="modal-title">{{ __('Edit User') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-span="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="hidden" name="profile_id" value="{{ $user->profile->id }}">

            <div class="form-group row">
                <span for="name" class="required col-md-4 col-form-span text-md-right">{{ __('Full Name') }}</span>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" >
                </div>
            </div>

            <div class="form-group row">
                <span for="document_id" class="required col-md-4 col-form-span text-md-right">{{ __('Document Id') }}</span>
                <div class="col-md-6">
                    <input id="document_id" type="text" class="form-control" name="document_id" value="{{ old('document_id', $user->profile->document_id) }}"/>
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
                <span for="contactno" class="required col-md-4 col-form-span text-md-right">{{ __('Contact No.') }}</span>
                <div class="col-md-6">
                    <input id="contactno" type="text" class="form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno', $user->profile->contactno) }}" required autocomplete="contactno" >
                </div>
            </div>

            <div class="form-group row">
                <span for="email" class="required col-md-4 col-form-span text-md-right">{{ __('E-Mail Address') }}</span>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                </div>
            </div>


            <div class="form-group row">
                <span for="address" class="required col-md-4 col-form-span text-md-right">{{ __('Address') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="address" >{{ $user->profile->address }}</textarea>
                </div>
            </div>

             <div class="form-group row">
                <span for="company" class="required col-md-4 col-form-span text-md-right">{{ __('Agency/Company') }}</span>
                <div class="col-md-6">
                    <textarea class="form-control" name="company" >{{ $user->profile->company }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <span for="password" class="col-md-4 col-form-span text-md-right">{{ __('Password') }}</span>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <span for="password-confirm" class="col-md-4 col-form-span text-md-right">{{ __('Confirm Password') }}</span>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <span for="role_id" class="required col-md-4 col-form-span text-md-right">{{ __('Role') }}</span>

                <div class="col-md-6">
                    <select id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id" autofocus>
                        <option value=""  selected hidden>Please Select</option>
                        @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('role_id',$user->role->id ?? "") == $id ) ? 'selected' : '' }}>{{$role}}</option>
                        @endforeach
                    </select>

                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <span for="status" class="required col-md-4 col-form-span text-md-right">{{ __('Status') }}</span>
                <div class="col-md-6">
                    <select class="form-control" name="status" required>
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

<script>
    $(function () {

        $('#agency_id').change(function(){
            var agencyID = $(this).val();
            $.ajax({
                type: "GET",
                url:  "{{url('util/getDepartments')}}?agency="+agencyID,
                success:function(res){
                        if(res){
                            $("#dept_id").empty();
                            $("#dept_id").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#dept_id").append('<option value="'+value.id+'">'+value.departmentName+'</option>');
                            });
                        }
                } //success
            });
        });

        $('#dept_id').change(function(){
            var deptID = $(this).val();
            $.ajax({
                type: "GET",
                url:  "{{url('util/getDivisions')}}?department="+deptID,
                success:function(res){
                        if(res){
                            $("#division_id").empty();
                            $("#division_id").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#division_id").append('<option value="'+value.id+'">'+value.divisionName+'</option>');
                            });
                        }
                } //success
            });
        });
    });
</script>

@endsection
