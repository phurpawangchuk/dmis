@extends('layouts.primary')

@section('content')

@include('partials.admin-message')

<div class="card">
    <div class="card-header">{{ __('Calendar') }}
        @can('event_create')
            <a class="btn bg-dark text-white float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.calendars.create') }}" title="Create Event"> <i class="fas fa-plus-circle"></i> Add New Calendar</a>
        @endcan
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead class="thead-light">
            <tr>
                <th>SL#</th>
                <th> Event Name</th>
                <th> Description </th>
                <th>Event Date</th>
                @if(Auth()->user()->role_id !=3)
                <th>Posted By</th>
                <th>Action</th>
                @endif

            </tr>
            </thead>
            <tbody>
            @foreach($calendars as $i=>$item)
                <tr>
                    <td>
                        @if(Session::get('pages') % $perPage == 0)
                            {{ Session::get('pages')+ $i+1 }}
                        @else
                            {{ $i * Session::get('pages')+1 }}
                        @endif
                    </td>
                    <td>{{ $item->event_name}}</td>
                    <td>{{ $item->description}}</td>
                    <td>{{ $item->event_date}}</td>
                    @if(Auth()->user()->role_id !=3)
                    <td>{{ isset($item->user->name) ? $item->user->name : '' }}</td>
                    <td>
                        @can('event_edit')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.calendars.edit', $item->id) }}" title="Edit"> <i class="fas fa-pencil"></i> Edit</a>
                        @endcan

                        @can('event_delete')
                        <form action="{{ route('dashboard.calendars.destroy', $item->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-2 float-right">
            {{ $calendars->links() }}
        </div>
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