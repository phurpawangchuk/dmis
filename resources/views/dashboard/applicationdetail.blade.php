@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'scrutinize'
])
@section('title','Scrutinize Applications')
@section('content')
@section('heading','Scrutinize Applications')
<div class="row">
    <div class="col-md-4">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ route('profile.image', $profile->cid) }}" alt="Profile Picture">
                </div>
                <h3 class="widget-user-username">{{$profile->name}}</h3>
                <h5 class="widget-user-desc">{{$profile->cid}}</h5>
            </div>
                <div class="card-footer p-0">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>Date of Birth</th><td>{{$profile->dob}}</td>
                        </tr>
                        <tr>
                            <th>Sex</th><td>{{$profile->sex}}</td>
                        </tr>
                        <tr>
                            <th>Email</th><td>{{$profile->email}}</td>
                        </tr>
                        <tr>
                            <th>Contact</th><td>{{$profile->contact}}</td>
                        </tr>
                        <tr>
                            <td colspan=2 class="text-center"><strong>Permanent Address</strong></td>
                        </tr>
                        <tr>
                            <th>Dzongkhag</th><td>{{$profile->dzongkhag->name}}</td>
                        </tr>
                        <tr>
                            <th>Gewog</th><td>{{$profile->gewog->name}}</td>
                        </tr>
                        <tr>
                            <th>Village</th><td>{{$profile->village->name}}</td>
                        </tr>
                        <tr>
                            <th>House Number</th><td>{{$profile->house_no}}</td>
                        </tr>
                        <tr>
                            <th>Thram Number</th><td>{{$profile->thram_no}}</td>
                        </tr>

                        <tr>
                            <td colspan=2 class="text-center"><strong>Current Address</strong></td>
                        </tr>
                        <tr>
                            <th>Dzongkhag</th><td>{{$profile->current_dzongkhag->name}}</td>
                        </tr>
                        <tr>
                            <th>Gewog</th><td>{{$profile->current_gewog->name}}</td>
                        </tr>
                        <tr>
                            <th>Village</th><td>{{$profile->current_village->name}}</td>
                        </tr>


                    </table>
                </div>
        </div>
    </div> 

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        Qualification Details
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th>Sl No</th><th>Qualification</th><th>School</th><th>Year</th><th>Score</th>
                            </tr>
                            @foreach($qualifications as $qualification)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$qualification->qualification->name}}</td>
                                <td>{{$qualification->school_name}}</td>
                                <td>{{$qualification->year}}</td>
                                <td>{{$qualification->score}}</td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        Document Details
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered">
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

        <form action="{{route('applications.applicationScrunity')}}" method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Scrutiny
                        </div>
                        <div class="card-body">
                            <p><strong>Scholarship Applied for - </strong><span>{{$scholarship->name}}</span></p>
                            <div class="row">
                                <div class="col-md-2">Status</div>
                                <div class="col-md-3">
                                    <select name="status" id="" class="form-control form-control-sm" required>
                                        <option value="">--SELECT STATUS--</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>  
                                    </select>
                                </div>  
                                <div class="col-md-2">Remark</div>
                                <div class="col-md-5">
                                    <input type="text" name="remark" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="hidden" name="scholarship" value="{{$scholarship->id}}">
                            <input type="hidden" name="profile" value="{{$profile->id}}">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>     
@endsection