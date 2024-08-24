@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="card-header">{{ __('Donation History') }}

    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL#</th>
                <th scope="col">Project</th>
                <th scope="col">Amount (Nu.)</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Jrn Number</th>
            	<th scope="col"> Receipt</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $item->project->name}}</td>
                    <td>{{ $item->amount}}</td>
                    <td>{{ $item->payment_date}}</td>
                    <td>{{ $item->payment_status}}</td>
                    <td>{{ $item->jrn}} </td>
                	<td><a href="{{url('donor/receipt',$item->id)}}">Click here will download line record receipt</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
