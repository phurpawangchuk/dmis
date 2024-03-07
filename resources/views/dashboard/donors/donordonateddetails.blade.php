@extends('layouts.primary')

@section('content')

<div class="card">

    <div class="modal-header">
        <h4 class="modal-title">{{ __('Donation List') }}</h4>
        <a href="{{ route('dashboard.donors.donorlist') }}" class="btn bg-dark text-white">
        <i class="nav-icon fa fa-arrow-back"></i>
            Back
        </a>
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead>
            <tr class="bg-warning text-light">
                <th scope="col">SL#</th>
                <th scope="col">Donor</th>
                <th scope="col">Project</th>
                <th scope="col">Amount (Nu.)</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Bank</th>
                <th scope="col">Jrn Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $item->user->name}}</td>
                    <td>{{ $item->project->name}}</td>
                    <td>{{ $item->actualamount}}</td>
                    <td>{{ $item->payment_date}}</td>
                    <td>{{ $item->bank}}</td>
                    <td>{{ $item->jrn}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
