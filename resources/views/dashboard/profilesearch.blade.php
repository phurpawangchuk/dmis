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
            <form action="{{ route('accounts.searchProfilebyCID') }}" method="get" class="form">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search by CID Number" name="cidsearch" value="{{ $cid}}" required>
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
        No Record found. Please check CID Number and try again
    </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-2">
        <div class="card card-outline card-info">
            <div class="card-body">
            <img src="{{ route('profile.image', $profile->cid) }}" alt="{{ route('profile.image', $profile->cid) }}" class="img-responsive" width="150" height="auto">
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header">Student Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th colspan="4" class="text-center">Personal Information</th>
                            </tr>
                            <tr>
                                <td><strong>CID ID</strong></td>
                                <td>{{$profile->cid}}</td>
                                <td><strong>Full Name</strong></td>
                                <td>{{$profile->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Sex</strong></td>
                                <td>{{$profile->sex}}</td>
                                <td><strong>Date of Birth</strong></td>
                                <td>{{$profile->dob}}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{$profile->email}}</td>
                                <td><strong>Contact Number</strong></td>
                                <td>{{$profile->contact}}</td>
                            </tr>
                        </table>

                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th></th><th>Permenant Address</th><th>Current Address</th>
                            </tr>
                            <tr>
                                <td><strong>Dzongkhag</strong></td>
                                <td>{{$profile->dzongkhag->name}}</td>
                                <td>{{$profile->current_dzongkhag->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Gewog</strong></td>
                                <td>{{$profile->gewog->name}}</td>
                                <td>{{$profile->current_gewog->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Village</strong></td>
                                <td>{{$profile->village->name}}</td>
                                <td>{{$profile->current_village->name}}</td>
                            </tr>
                        </table>

                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th colspan="4" class="text-center">Qualifications</th>
                            </tr>
                            <tr>
                                <th>Qualification</th><th>School</th><th>Year</th><th>Score</th>
                            </tr>
                            @foreach($qualifications as $qualification)
                           <tr>
                               <td>{{$qualification->qualification->name}}</td>
                               <td>{{$qualification->school_name}}</td>
                               <td>{{$qualification->year}}</td>
                               <td>{{$qualification->score}}</td>
                           </tr>
                           @endforeach
                        </table>

                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th colspan="3" class="text-center">Documents</th>
                            </tr>
                            <tr>
                                <th>Document Name</th><th>File Name</th><th></th>
                            </tr>
                            @foreach($documents as $document)
                            @php
                                $filename=$profile->cid."_".$document->document->id."_".$document->src;
                            @endphp
                           <tr>
                               <td>{{$document->document->name}}</td>
                               <td>{{$document->src}}</td>
                               <td><a href="{{ route('profile.document',$filename) }}" class="btn btn-xs btn-primary">
                                   <i class="fa fa-download"></i></a>
                                </td>
                           </tr>
                           @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

   
</div>
@endif
@endsection