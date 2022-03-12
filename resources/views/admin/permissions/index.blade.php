@extends('layouts.admin')

@section('content')

<div class="card">

        <div class="card-header">{{ __('Permissions List') }}
            @can('permission_create')
                <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('admin.permissions.create') }}" title="Create permission"> <i class="fas fa-plus-circle"></i> Add permission</a>
            @endcan
        </div>
        
        @include('layouts.messages')
        <div class="card-body">
                <table class="table table-bordered table-sm">
                            <tr class="bg-info text-light">
                                <th class="text-center">ID</th>
                                <th>Name</th>
                                <th>Short Code</th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                    @forelse ($permissions as $i =>$permission)
                        <tr>
                            <td class="text-center">
                                @if(Session::get('pages') % $perPage == 0)
                                    {{ Session::get('pages')+ $i+1 }}
                                @else
                                    {{ $i * Session::get('pages')+1 }}
                                @endif
                            </td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->description}}</td>
                            <td>
                                    @can('permission_edit')
                                        <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('admin.permissions.edit', $permission->id) }}" title="Edit permission"> <i class="fas fa-pencil"></i> Edit</a>
                                    @endcan
                                    
                                    @can('permission_delete')
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted py-3">No Permissions Found</td>
                            </tr>
                    @endforelse
                </table>

                {{ $permissions->links() }}

        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Permission Management </h4>
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
