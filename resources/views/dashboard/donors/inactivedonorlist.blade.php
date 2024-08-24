@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="card-header" style="font-weight:bold">{{ __('Inactive Donor List') }}
    </div>

    <div class="card-body">
        <table id="example"  class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL#</th>
                <th scope="col">Donor</th>
                <th scope="col">CID No.</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $i=>$item)
            @php $param = $item->id.'-Inactive'; @endphp
                <tr>
                    <td>{{$i+1}}</td>
                    <td><a href="{{ route('dashboard.donors.donordetails',$param)}}">{{ $item->name}}</a></td>
                    <td>{{ $item->profile->document_id}}</td>
                    <td>{{ $item->email}}</td>
                    <td>{{ $item->profile->contactno}}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="btn btn-sm btn-warning">&nbsp;Active&nbsp;</span>
                        @elseif ($item->status == 0)
                            <span class="btn btn-sm btn-danger">InActive</span>
                        @endif
                    </td>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
