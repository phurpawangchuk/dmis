@extends('layouts.primary')

@section('content')

@include('partials.admin-message')

<div class="card">
    <div class="card-header">{{ __('Fund Utilization Report') }}
        @can('event_create_1')
            <a class="btn btn-primary btn-sm text-light float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.fundutils.create') }}" title="Create New Fund Used"> <i class="fas fa-plus-circle"></i> Add New Fund Utilization</a>
        @endcan
    </div>

    <div class="card-body">
    @if ($fundutils->isNotEmpty())
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead class="thead-light">
            <tr>
                <th>SL#</th>
                <th>Donor Name</th>
                <th>Project</th>
                <th>Total Amt Contributed</th>
                <th>Total Amt Used</th>
                <th>Short Description</th>
                <th>Updated On</th>
                <th>Utilization Report</th>
                @if(Auth()->user()->role_id < 3)
                    <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($fundutils as $i=>$item)
                @php
                    $file = App\Http\Controllers\Admin\FundUtilController:: reportFile($item->donor_id,$item->project_id);
                @endphp
                <tr>
                    <td>
                        @if(Session::get('pages') % $perPage == 0)
                            {{ Session::get('pages')+ $i+1 }}
                        @else
                            {{ $i * Session::get('pages')+1 }}
                        @endif
                    </td>
                    <td>
                    @php
                        echo App\Http\Controllers\Admin\FundUtilController::getDonorName($item->donor_id);
                    @endphp
                    </td>

                    <td>
                    @php
                        echo App\Http\Controllers\Admin\FundUtilController::getProjectName($item->project_id);
                    @endphp
                    </td>

                    <td>{{ $item->totalAmt}}</td>

                     <td>
                        @php
                            echo App\Http\Controllers\Admin\FundUtilController::amountUsed($item->donor_id,$item->project_id);
                        @endphp
                     </td>

                     <td>
                        @php
                            echo App\Http\Controllers\Admin\FundUtilController::shortCode($item->donor_id,$item->project_id);
                        @endphp
                    </td>

                    <td>{{ substr($item->updated_at,0,11)}}</td>

                    <td>
                       @if (!empty($file))
                        <a href="{{ $folderPath }}{{ $file }}" target="_blank" class="btn btn-sm btn-warning">View Report</a>
                        @else
                         No report attched
                        @endif
                    </td>
                    @if(Auth()->user()->role_id < 3)
                     <td>
                        @can('fundutil_edit')
                            <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.fundutils.edit', $item->donor_id.'-'.$item->project_id) }}" title="Edit"> <i class="fas fa-pencil"></i> Edit</a>
                        @endcan

                        @can('fundutil_delete')
                        <form action="{{ route('dashboard.fundutils.destroy', $item->id) }}" class="d-inline-block" method="post">
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
            {{ $fundutils->links() }}
        </div>
    @else
        <div>
            <div class="text-center mt-5 py-5">
                <i class="fa fa-search fa-lg"></i>
                <p class="text-lg">No fund Utilization found.</p>
            </div>
        </div>
    @endif
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
