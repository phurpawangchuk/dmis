@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="card-header">{{ __('Donation Report') }}
        <form method="POST" action="{{ route('dashboard.donors.search') }}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-sm-3 mx-auto"> 
                    <label for="event_date">{{ __('From Date') }}</label>
                    <input type="date" class="form-control" name="from" required>
                </div>
                
                <div class="col-sm-3 mx-auto"> 
                    <label for="event_date">{{ __('To Date') }}</label>
                    <input type="date" class="form-control" name="to" required>
                </div>

                <div class="col-sm-3 mx-auto"> 
                    <label for="project">{{ __('Project Category') }}</label>
                    <select name="project_id" class="form-control" required>
                        @foreach ($projects as $p)
                            <option value="{{$p->id}}">{{ $p->name}}</option>
                        @endforeach
                        <option value="All">All</option>
                    </select>
                </div>

                <div class="col-sm-3 mt-2 mx-auto">
                    <button class="btn mt-4 btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table id="example"  class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL#</th>
                <th scope="col">Project</th>
                <th scope="col">Donor</th>
                <th scope="col">Amount</th>
                <th scope="col">Bank</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Jrn Number</th>
                <th scope="col">Actual Amt Received</th>
                @if($roleId != 3)
                <th scope="col">Jrn Verified</th>
                <th scope="col">Action</th>
                @endif
                <th scope="col">Receipt</th>
            </tr>
            </thead>
            <tbody>
            @foreach($donors as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $item->project->name}}</td>
                    <td>{{ $item->user->name}}</td>
                    <td>{{ $item->amount}}</td>
                    <td>{{ $item->bank}}</td>
                    <td>{{ $item->payment_date}}</td>
                    <td>{{ $item->jrn}} </td>
                    <td>{{ $item->actualamount}}</td>
                    @if($roleId != 3)
                    <td>{{ empty($item->is_verified) ? 'No':'Yes'}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.donors.edit', $item->id) }}" title="Update Jrn"> <i class="fas fa-pencil"></i> Update Jrn</a>
                    </td>
                    @endif

                    @if(!empty($item->is_verified) || $item->is_verified > 0)
                    <td><a  href="{{url('donor/receipt',$item->id)}}">Download receipt</a></td>
                    @else
                    <td>Not available as payment is not yet verified.</td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
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
