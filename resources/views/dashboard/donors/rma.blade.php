@extends('layouts.primary')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Roles List') }}
        @can('role_create')
            <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.roles.create') }}" title="Create role"> <i class="fas fa-plus-circle"></i> Add Role</a>
        @endcan
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">SL#</th>
                <th scope="col">Project</th>
                <th scope="col">Donor</th>
                <th scope="col">Amount (Nu.)</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Reference No</th>
                <!-- <th scope="col">Txn. No</th> -->
                <th scope="col">Payment Status</th>
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
                    <td>{{ $item->payment_status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
           
</div>


 <!--  modal -->
 <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog content modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="userBody">
            </div>
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