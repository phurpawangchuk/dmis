@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])

@section('content')

@include('partials.admin-message')

<div class="card">

    <div class="card-header">{{ __('Internal System Users') }}
        @can('user_create')
            <a class="btn bg-dark text-white float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.users.create') }}" title="Create user"> <i class="fas fa-plus-circle"></i> Add New User</a>
        @endcan
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead class="thead-light">
                <tr class="bg-info text-light">
                    <th>ID</th>
                    <th>Name</th>
                 <th>Dob(yyyy-mm-dd)</th>
                    <th>ContactNo</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Agency/Company</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            @forelse ($users as $i =>$user)
                <tr>
                    <td class="text-center">
                        @if(Session::get('pages') % $perPage == 0)
                            {{ Session::get('pages')+ $i+1 }}
                        @else
                            {{ $i * Session::get('pages')+1 }}
                        @endif
                    </td>
                    <td>{{ $user->name}}</td>
                        <td>{{$user->dob}}</td>
                    <td>{{ $user->profile->contactno}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->profile->address}}</td>
                    <td>{{ $user->profile->company}}</td>
                    <td>{{ $user->role->role_name ?? "--"}}</td>
                    <td>
                        @if ($user->profile->status == 1)
                            <span class="btn btn-sm btn-warning">&nbsp;Active&nbsp;</span>
                        @elseif ($user->profile->status == 0)
                            <span class="btn btn-sm btn-danger">InActive</span>
                        @endif
                    </td>
                    <td>
                        @can('user_edit')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.users.edit', $user->id) }}" title="Edit post"> <i class="fas fa-pencil"></i> Edit</a>
                        @endcan

                        @can('user_delete')
                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan

                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center text-muted py-3">No Users Found</td>
                    </tr>
            @endforelse
        </table>

        @if($users->total() > $users->perPage())
            {{$users->links()}}
        @endif

    </div>
</div>

 <!-- modal -->
<div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="postLabelBody" aria-hidden="true">
    <div class="modal-dialog content modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="userBody">
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/js/jquery.min.js')}}"></script>

<script>
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
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            },
            timeout: 8000
        })
    });
</script>
@endsection

