@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="card-header">{{ __('QR Scan payment List') }}
        @can('user_create')
            <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.users.create') }}" title="Create user"> <i class="fas fa-plus-circle"></i> Add New QR Scan payment</a>
        @endcan
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-info text-light">
                <th scope="col">SL#</th>
                <th scope="col">Project</th>
                <th scope="col">Donor</th>
                <th scope="col">Amount (Nu.)</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Journal No</th>
                <th scope="col">Verified</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $item->project->name}}</td>
                    <td>{{ $item->user->name}}</td>
                    <td>{{ $item->amount}}</td>
                    <td>{{ $item->payment_date}}</td>
                    <td>{{ $item->orderNo}}</td>
                    <td>{{ $item->is_verified}}</td>
                    <td>
                        @can('user_edit')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.users.edit', $item->id) }}" title="Edit post"> <i class="fas fa-pencil"></i> Edit</a>
                        @endcan

                        @can('user_delete')
                        <form action="{{ route('dashboard.users.destroy', $item->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        
    </div>
</div>


 <!--  modal -->
 <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
<!-- <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="postLabelBody" aria-hidden="true"> -->
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-body" id="userBody">
            <div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/jquery.min.js')}}"></script>

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
            timeout: 8000
        })
    });
</script>
@endsection