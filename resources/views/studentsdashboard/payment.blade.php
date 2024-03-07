
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
                        <div class="card-header">How much would you like to Donate?</div>
                        <div class="card-body">


                        <form method="POST" action="{{route('sLogins')}}">
                    @csrf
                    @method('POST')
                        <div class="form-group has-feedback">
                            <label for="">Enter Amount</label>
                            <div class="input-group">
                                <input id="number" type="number" class="form-control" placeholder="Enter Amount" >
                                <div class="input-group-append">
                                    <div class="input-group-text">

                                    </div>
                                </div>

                            </div>

                        </div>



                        <button type="submit" class="btn btn-primary btn-block btn-lg" data-
            toggle="modal" data-target="#demoModal">Continue</button>

                    </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>




@endsection
