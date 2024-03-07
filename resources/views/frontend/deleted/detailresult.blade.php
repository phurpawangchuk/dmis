@extends('frontend.index')
@section('title','Result Details')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-header text-center"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Result Detail</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Title</th><th>Type</th><th>Slot</th><th>Fund</th><th>Open Date</th><th>Close Date</th>
                                    </tr>
                                    <tr>
                                        <td>{{$scholarship->name}}</td>
                                        <td>{{$scholarship->type}}</td>
                                        <td>{{$scholarship->slot}}</td>
                                        <td>{{$scholarship->scholarshipsponser->sum('fund')}}</td>
                                        <td>{{$scholarship->open_date}}</td>
                                        <td>{{$scholarship->close_date}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table class="table table-sm table-hover table-striped">
                                    <tr>
                                        <th>Sl No</th><th>CID Number</th><th>Name</th><th>Sex</th><th>Permenant Address</th>
                                    </tr>
                                   
                                    @foreach($profiles as $profile)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$profile->cid}}</td>
                                        <td>{{$profile->name}}</td>
                                        <td>{{$profile->sex}}</td>
                                        <td>{{$profile->village->name}} , {{$profile->gewog->name}} , {{$profile->dzongkhag->name}}</td>
                                    </tr>

                                    @endforeach
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
</div> 



@endsection