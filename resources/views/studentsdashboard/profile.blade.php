@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'profile'
])
@section('title','My Profile')
@section('content')
@section('heading','My Profile')
@include('partials.admin-message')
@if($profile)
<div class="row">
  <div class="col-md-2">
    <div class="card card-outline card-danger">
       <div class="card-body table-responsive">
         <img src="{{ route('profile.image', $profile->cid) }}" alt="profile image" class="img-responsive" width="150" height="auto">
       </div>
       <div class="card-footer">
        
       </div>
       <a href="{{ route('accounts.profileDetails', $profile->cid) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"> Edit Profile</i></a>
       
     </div>
  </div>
  <div class="col-md-10">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-outline card-primary">
          <div class="card-header">Personal Information</div>
            <div class="card-body table-responsive">
              <table class="table table-sm  table-striped">
                <tr>
                  <td><strong>CID Number</strong></td><td>{{ $profile->cid}}</td>
                </tr>
                <tr>
                  <td><strong>Full Name</strong></td><td>{{ $profile->name}}</td>
                </tr>
                <tr>
                  <td><strong>Sex</strong></td><td>{{ $profile->sex}}</td>
                </tr>
                <tr>
                  <td><strong>Date of Birth</strong></td><td>{{ $profile->dob}}</td>
                </tr>
                
              </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-outline card-warning">
          <div class="card-header">Contact Information</div>
            <div class="card-body table-responsive">
              <table class="table table-sm  table-striped">
                <tr>
                  <td><strong>Email</strong></td><td>{{ $profile->email}}</td>
                </tr>
                <tr>
                  <td><strong>Contact No.</strong></td><td>{{ $profile->contact}}</td>
                </tr>
                <tr>
                  <td><strong>House Number</strong></td><td>{{ $profile->house_no}}</td>
                </tr>
                <tr>
                  <td><strong>Thram No</strong></td><td>{{ $profile->thram_no}}</td>
                </tr>
                
              </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-outline card-warning">
          <div class="card-header">Permanent Address</div>
            <div class="card-body table-responsive">
              <table class="table table-sm  table-striped">
                <tr>
                  <td><strong>Dzongkhag</strong></td><td>{{ ($profile->dzongkhag)?$profile->dzongkhag->name:""}}</td>
                </tr>
                <tr>
                  <td><strong>Gewog</strong></td><td>{{ ($profile->gewog)?$profile->gewog->name:""}}</td>
                </tr>
                <tr>
                  <td><strong>Village</strong></td><td>{{ ($profile->village)?$profile->village->name:""}}</td>
                </tr>
                
              </table>
            </div>
          </div>
      </div>
<!-- end -->
      <div class="col-md-6">
        <div class="card card-outline card-primary">
          <div class="card-header">Current Address</div>
            <div class="card-body table-responsive">
              <table class="table table-sm  table-striped">
                <tr>
                  <td><strong>Dzongkahag</strong></td><td>{{ ($profile->current_dzongkhag)?$profile->current_dzongkhag->name:""}}</td>
                </tr>
                <tr>
                  <td><strong>Gewog</strong></td><td>{{ ($profile->current_gewog)?$profile->current_gewog->name:""}}</td>
                </tr>
                <tr>
                  <td><strong>Village</strong></td><td>{{ ($profile->current_village)?$profile->current_village->name:""}}</td>
                </tr>
               
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

@endif
      
@endsection