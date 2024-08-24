@extends('frontend.index')
@section('title','Scholarshi Details')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-header text-center"></div>
        <div class="content">
            <div class="container">
   
                <div class="row">
                    <div class="col-md-6">
                        <h4>Scholarship Details</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/loginRegister" class="btn btn-flat  btn-primary"><i class="fa fa-play"></i> Online Application </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header"> {{$scholarshipdetail->name}}</div>
                                    <div class="card-body">
                                        {{$scholarshipdetail->description}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-outline card-danger">
                                    <div class="card-header"> Eligibility Criteria</div>
                                    <div class="card-body">
                                        {{$scholarshipdetail->eligibility}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-outline card-danger">
                                    <div class="card-header"> Selection Criteria</div>
                                    <div class="card-body">
                                        {{$scholarshipdetail->selection}}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">Slots</div>
                                    <div class="card-body">
                                        {{$scholarshipdetail->slot}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">Total Fund</div>
                                    <div class="card-body">
                                        {{$scholarshipdetail->scholarshipsponser->sum('fund')}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div> 



@endsection