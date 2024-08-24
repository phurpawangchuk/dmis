@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])


@section('content')

<div class="card">

        <div class="card-header">{{ __('Permissions List') }}
            @can('permission_create')
                <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.permissions.create') }}" title="Create permission"> <i class="fas fa-plus-circle"></i> Add permission</a>
            @endcan
        </div>
        
        <div class="card-body">
            <table id="dataTable" class="table table-striped table-responsive-sm table-bordered table-sm" style="width:100%">
                    <thead>
                         <tr class="bg-info text-light">
                            <th class="text-center">ID</th>
                            <th>Name</th>
                            <th>Short Code</th>
                            <th>
                            </th>
                        </tr>
                    <thead>
                    <tbody>
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
                                    <a class="btn btn-sm btn-success" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.permissions.edit', $permission->id) }}" title="Edit permission"> <i class="fas fa-pencil"></i> Edit</a>
                                @endcan
                                
                                @can('permission_delete')
                            <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" class="d-inline-block" method="post">
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
            </tbody>
                @endforelse
            </table>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="postLabelBody" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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

    $(document).ready(function() {
    var table = $('#dataTable').DataTable( {
        lengthChange: false,
        buttons: [ 
            'copy', 
            'excel', 
            'pdf', 
            'colvis' 
        ]
    } );
 
    table.buttons().container()
        .appendTo( '#dataTable_wrapper .col-md-6:eq(0)' );
    } );
</script>


<!-- added for DataTable -->
@section('scripts')
        <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/js/excel.min.js')}}"></script>
        <script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
         <script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/js/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
    @endsection 

@endsection
