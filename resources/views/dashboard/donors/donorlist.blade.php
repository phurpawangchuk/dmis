@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="card-header" style="font-weight:bold">{{ __('Donor List') }}

    </div>

    <div class="card-body">
        <table id="example"  class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL# (Rankwise)</th>
                <th scope="col">Donor</th>
                <th scope="col">CID No.</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Total Amt Contributed</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($getdonortotalamt as $i=>$item)
            @php $param = $item->user->id.'-Active'; @endphp
                <tr>
                    <td>{{$i+1}}</td>
                    <td><a href="{{ route('dashboard.donors.donordetails',$param)}}">{{ $item->user->name}}</a></td>
                    <td>
                    <?php
                        $getcid=DB::table('user_profiles')->where('user_id',$item->user->id)->first();
                        echo $getcid->document_id;
                    ?>
                    </td>
                    <td>{{ $item->user->email}}</td>
                    <td>
                    <?php
                        $getcid=DB::table('user_profiles')->where('user_id',$item->user->id)->first();
                        echo $getcid->contactno;
                    ?>

                    </td>

                    <td><a href="{{ route('dashboard.donors.donordonateddetails',$item->user->id)}}">{{ $item->Amount}}</a></td>
                    <td>
                    <?php
                    $result=DB::table('user_profiles')->where('user_id',$item->user->id)->first();
                        ?>
                        @if ($result->status == 1)
                            <span class="btn btn-sm btn-warning">&nbsp;Active&nbsp;</span>
                        @elseif ($result->status == 0)
                            <span class="btn btn-sm btn-danger">InActive</span>
                        @endif
                    </td>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <h6 style="font-weight:bold">List of Frequent Donors</h6><hr>
        <table id="example1"  class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL#</th>

                <th scope="col">Donor</th>
                <th scope="col">CID No.</th>
                <th scope="col">Total times donated</th>

            </tr>
            </thead>
            <tbody>
            @foreach($getfrqdonor as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>

                    <td>{{ $item->user->name}}</td>
                    <td>
                    <?php
                        $getcid=DB::table('user_profiles')->where('user_id',$item->user->id)->first();
                        echo $getcid->document_id;
                    ?>
                    </td>
                    <td>{{ $item->total}}</td>


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
