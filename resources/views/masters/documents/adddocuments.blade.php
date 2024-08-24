@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Add Donor ')
@section('content')
@section('heading','Add Donor')
<form action="{{route('documents.store')}}" class="form-horizontal" method="Post">
    @csrf
    @method('POST')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3">Name</label>
                    <input type="text" name="dname" class="form-control form-control-sm"  id="inputEmail3" placeholder="Donor Name" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail3">CID No / Passport No</label>
                    <input type="text" name="dname" class="form-control form-control-sm"  id="inputEmail3" placeholder="CID Number / passport number" >
                </div>
                <div class="form-group">
                    <label for="inputEmail3">Email</label>
                    <input type="text" name="dname" class="form-control form-control-sm"  id="inputEmail3" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail3">Contact no.</label>
                    <input type="text" name="dname" class="form-control form-control-sm"  id="inputEmail3" placeholder="Contact Number" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail3">Country</label>
                    <input type="text" name="dname" class="form-control form-control-sm"  id="inputEmail3" placeholder="Country" required>
                </div>




            </div>
        </div>
    </div>

    <div class="col-md-10 text-right">
        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Submit </button>

    </div>

</form>


@endsection
