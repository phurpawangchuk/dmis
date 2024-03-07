@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'home'
])
@section('title','Profile Search')
@section('content')
@section('heading','Profile Search')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
            <form action="{{ route('accounts.searchProfilebyName') }}" method="get" class="form">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search by Name" name="namesearch" value="{{ $oldname }}" required>
                        <span class="input-group-append">
                        <button  class="btn btn-info btn-flat">Search</button>
                        </span>
                </div>
            </form>  
            </div>                
        </div>
    </div>
@if($profilecheck==0)
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
        No Record found. Please check the Name and try again
    </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">Students with Name like '{{$oldname}}'</div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped">
                    <tr><th>Sl No</th><th>CID No</th><th>Full Name</th><th>Sex</th><th>Date of Birth</th><th></th></tr>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$profile->cid}}</td>
                            <td>{{$profile->name}}</td>
                            <td>{{$profile->sex}}</td>
                            <td>{{$profile->dob}}</td>
                            <td>
                                <form action="{{ route('accounts.searchProfilebyCID') }}" method="get">
                                    <input type="hidden" value="{{$profile->cid}}" name="cidsearch">
                                    <button class="btn btn-xs btn-info">More <i class="fa fa-play"></i></button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </table>

            </div>

        </div>
    </div>
</div>

@endif
@endsection