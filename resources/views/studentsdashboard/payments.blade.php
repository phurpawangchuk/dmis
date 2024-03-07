@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'home'
])

@section('content')
<div class="container">

            <div class="row">
                <div class="col-md-8">
                    <h4>Donation Management Information System</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info card-outline">
                        <div class="card-header">Please enter your bank details</div>
                        <div class="card-body">


                        <form method="POST" action="{{route('otp')}}">
                    @csrf
                    @method('POST')
                        <div class="form-group has-feedback">
                        <select class="browser-default custom-select" name="category" id="category">
                        <option selected>Select Bank</option>

                        <option value="Institute of WellBeing">Bank of Bhutan</option>
                        <option value="Institute of WellBeing">BNBL</option>
                        <option value="Institute of WellBeing">TBANK</option>
                        <option value="Institute of WellBeing">PNB</option>

                    </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="">Bank Account Number</label>
                            <div class="input-group">
                                <input id="number" type="number" class="form-control" placeholder="Enter Account Number" >
                                <div class="input-group-append">
                                    <div class="input-group-text">

                                    </div>
                                </div>

                            </div>

                        </div>



                        <button type="submit" class="btn btn-primary btn-block btn-lg">Continue</button>

                    </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>




@endsection
