@extends('layouts.admin')

@section('content')

    <div class="card">

        <div class="card-header">{{ __('Roles List') }}
            @can('role_create')
                <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('admin.roles.create') }}" title="Create role"> <i class="fas fa-plus-circle"></i> Add Role</a>
            @endcan
        </div>
        @include('layouts.messages')
        
        <div class="card-body">
            <table class="table table-bordered table-sm">
                    <tr class="bg-info text-light">
                        <th class="text-center">ID</th>
                        <th>Role</th>
                        <th>Short Code</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    @forelse ($roles as $i =>$role)
                    <tr>
                        <td class="text-center">
                            @if(Session::get('pages') % $perPage == 0)
                                {{ Session::get('pages')+ $i+1 }}
                            @else
                                {{ $i * Session::get('pages')+1 }}
                            @endif
                        </td>
                        <td>{{$role->role_name}}</td>
                        <td>{{$role->short_code ?? '--'}}</td>
                        <td>
                                @can('role_show')
                                    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-success">View</a>
                                @endcan

                                @can('role_edit')
                                    <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('admin.roles.edit', $role->id) }}" title="Edit role"> <i class="fas fa-pencil"></i> Edit</a>
                                @endcan

                                @can('role_delete')
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endcan
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center text-muted py-3">No Roles Found</td>
                        </tr>
                @endforelse
            </table>

            @if($roles->total() > $roles->perPage())
                {{$roles->links()}}
            @endif

        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Role Management </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="userBody">
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).on('click', '#userButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
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
               // $('#loader').hide();
            },
            timeout: 8000
        })
    });
</script>
@endsection
