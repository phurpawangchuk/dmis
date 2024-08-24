
<nav class="main-header navbar navbar-expand  navbar-dark p-2" style="background-color:#f9c013">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
@php
$elementActive = '';
@endphp

    <ul class="navbar-nav ml-auto">

		<!-- @can('master_setting')
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle user-panel" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="nav-icon fa fa-cubes pr-1"></i> Masters
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="{{ route('dashboard.projects.index') }}" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fa fa-file-pdf"></i> Project </a>
				<a class="dropdown-item" href="/Qualifications/index" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fa fa-map-signs"></i> Qualifications</a>
				<a class="dropdown-item" href="/Institutes/index" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fa fa-university"></i> Institutes</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="/Sponsers/index" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fa fa-credit-card"></i> Manage Sponsors</a>
			</div>
		</li>
		@endcan -->
        @if(Auth::user()->role_id==1||Auth::user()->role_id==2)
         <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle user-panel noc"  id="navbarDropdown" role="button" data-toggle="dropdown"><span class="badge badge-danger count"  style="border-radius:10px;"></span><i class="fa fa-bell pr-1" aria-hidden="true"></i></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="list">

            </div>
        </li>
        @endif

		@can('system_setting')
		<li class="nav-item dropdown">

			<a class="nav-link dropdown-toggle user-panel" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="nav-icon fa fa-cog pr-1"></i> Systems
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			@can('user_panel_access')
				<a class="dropdown-item" href="{{ route('dashboard.users.index') }}" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fas fa-users"></i> Manage Users</a>
			@endcan
			@can('role_panel_access')
				<a class="dropdown-item" href="{{ route('dashboard.roles.index') }}" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fas fa-users"></i> Roles</a>
			@endcan
			@can('permission_panel_access')
				<a class="dropdown-item" href="{{ route('dashboard.permissions.index') }}" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}"><i class="fas fa-users"></i> Permissions</a>
			@endcan
			</div>
		</li>
		@endcan


		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle user-panel" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="nav-icon fas fa-user pr-1"></i> {{Auth::user()->name}}
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="{{ route('dashboard.users.profile', Auth()->user()->id) }}"><i class="fas fa-user"></i> Profile</a>
					<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{ route('dashboard.users.changepwd') }}"><i class="fas fa-key"></i> Change Password</a>
					<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</li>
	</ul>

  </nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
</form>
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog content modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="userBody">
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/jquery.min.js')}}"></script>
<script>
$(document).ready(function(){

 function load_unseen_notification()
 {
  $.ajax({
   url:"{{url('admin/noc')}}",
   method:"POST",
   data:{_token: '{{csrf_token()}}'},
   dataType:"json",
   success:function(data)
   {
   $('#list').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
    else{
      $('.count').html('');
    }
   }
  });
 }

 load_unseen_notification();

/* $('.noc').on('click', function(event){
  event.preventDefault();

  $.ajax({
   url:"{{url('admin/nocup')}}",
   method:"POST",
   data:{_token: '{{csrf_token()}}'},
   dataType:"json",
   success:function(data)
   {
    $('.count').html('');

   }

   });
 });*/


 setInterval(function(){
  load_unseen_notification();;
 }, 5000);

});
$(document).on('click', '#userButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(result) {
                $('#userModal').show();
                $('#userBody').html(result).show();

            },
            complete: function() {
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
</script>

