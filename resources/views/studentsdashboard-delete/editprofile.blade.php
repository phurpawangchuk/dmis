@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'myprofile'
])
@section('title','Edit Profile')
@section('content')
@section('heading','Edit Profile')

<form action="{{ route('accounts.profileUpdate',$profile->cid) }}" class="form" method="POST" enctype="multipart/form-data">
  @csrf
  @method('POST')
<div class="row">
  <div class="col-md-2">
    <div class="card card-outline card-danger">
      <div class="form-group">
        <input type="file" class="form-control btn btn-primary btn-sm" name="profile_pic" id="photo" accept="image/jpg,image/png,image/jpeg,image/gif">
      </div>
      <div class="card-body image-holder twxt-center">
        <img src="{{ route('profile.image', $profile->cid) }}" alt="profile image" id="imgPreview" name="profile-picture">
      </div>
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
                  <td><strong>CID Number</strong></td><td><input type="text" class="form-control form-control-sm" name="cid" value="{{ $profile->cid}}" readonly></td>
                </tr>
                <tr>
                  <td><strong>Full Name</strong></td><td><input type="text" class="form-control form-control-sm" name="fullname" value="{{ $profile->name}}" readonly></td>
                </tr>
                <tr>
                  <td><strong>Sex</strong></td>
                  <td>
                    <select name="sex" id="" class="form-control form-control-sm" required>
                        <option value="">--Select Sex--</option>
                        <option value="Male" {{ ($profile->sex=='Male'?'selected':'') }}>Male</option>
                        <option value="Female" {{ ($profile->sex=='Female'?'selected':'') }}>Female</option>
                    </select>
                      </td>
                </tr>
                <tr>
                  <td><strong>Date of Birth</strong></td><td><input type="text" id="datepicker" class="form-control form-control-sm" name="dob" value="{{ $profile->dob}}" required readonly></td>
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
                  <td><strong>Email</strong></td><td><input type="text" class="form-control form-control-sm" name="email" value="{{ $profile->email}}" readonly></td>
                </tr>
                <tr>
                  <td><strong>Contact No.</strong></td><td><input type="text" class="form-control form-control-sm" name="contact" value="{{ $profile->contact}}" required></td>
                </tr>
                <tr>
                  <td><strong>House Number</strong></td><td><input type="text" class="form-control form-control-sm" name="house_no" value="{{ $profile->house_no}}" required></td>
                </tr>
                <tr>
                  <td><strong>Thram No</strong></td><td><input type="text" class="form-control form-control-sm" name="thram_no" value="{{ $profile->thram_no}}" required></td>
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
                  <td><strong>Dzongkhag</strong></td>
                  <td>
                    <select name="p_dzongkhag_id" id="" class="form-control form-control-sm dzongkhag-ddl load_gewogs" required>
                        <option value="">--SELECT DZONGKHAG --</option>
                        @foreach($dzongkhags as $dzongkhag)
                            <option value="{{ $dzongkhag->id }}" {{ ($dzongkhag->id==$profile->p_dzongkhag_id?'selected':'') }}>{{ $dzongkhag->name }}</option>
                        @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><strong>Gewog</strong></td>
                  <td>
                  <select name="p_gewog_id" id="" class="form-control form-control-sm gewog-ddl load_villages" required>
                    <option value="">--SELECT GEWOG --</option>
                    @foreach($gewogs as $gewog)
                          <option value="{{ $gewog->id }}" {{ ($gewog->id==$profile->p_gewog_id?'selected':'') }}>{{ $gewog->name }}</option>
                    @endforeach
                  </select>
                  </td>
                </tr>
                <tr>
                  <td><strong>Village</strong></td><td>
                  <select name="p_village_id" id="" class="form-control form-control-sm village-ddl" required>
                    <option value="">--SELECT VILLAGE --</option>
                    @foreach($villages as $village)
                          <option value="{{ $village->id }}" {{ ($village->id==$profile->p_village_id?'selected':'') }}>{{ $village->name }}</option>
                    @endforeach
                  </select>
                  </td>
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
                  <td><strong>Dzongkahag</strong></td>
                  <td><select name="c_dzongkhag_id" id="" class="form-control form-control-sm cdzongkhag-ddl cload_gewogs" required>
                        <option value="">--SELECT DZONGKHAG --</option>
                        @foreach($dzongkhags as $dzongkhag)
                            <option value="{{ $dzongkhag->id }}" {{ ($dzongkhag->id==$profile->c_dzongkhag_id?'selected':'') }}>{{ $dzongkhag->name }}</option>
                        @endforeach
                    </select></td>
                </tr>
                <tr>
                  <td><strong>Gewog</strong></td>
                  <td><select name="c_gewog_id" id="" class="form-control form-control-sm cgewog-ddl cload_villages" required>
                    <option value="">--SELECT GEWOG --</option>
                    @foreach($gewogs as $gewog)
                          <option value="{{ $gewog->id }}" {{ ($gewog->id==$profile->c_gewog_id?'selected':'') }}>{{ $gewog->name }}</option>
                    @endforeach
                  </select></td>
                </tr>
                <tr>
                  <td><strong>Village</strong></td>
                  <td><select name="c_village_id" id="" class="form-control form-control-sm cvillage-ddl" required>
                    <option value="">--SELECT VILLAGE --</option>
                    @foreach($villages as $village)
                          <option value="{{ $village->id }}" {{ ($village->id==$profile->c_village_id?'selected':'') }}>{{ $village->name }}</option>
                    @endforeach
                  </select></td>
                </tr>
               
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-12 text-right">
        <button class="btn btn-primary btn-sm"><i class="fa fa-check"> </i> Update Profile</button>
    </div>
</div>
  </form> 
      
@endsection

@push('styles')
    <style>
        .image-holder img  {
            height: 150px;
            width: 150px;
            border: 2px solid black;
        }
    </style>
@endpush
@push('scripts')
<script src="{{ asset('js/relateddata.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#photo').change(function(){
            const file = this.files[0];
            console.log(file);
            if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                console.log(event.target.result);
                $('#imgPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            }
        
        });   
        
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-70:+0",
          dateFormat: 'yy-mm-dd'
        });
    });
</script>
@endpush