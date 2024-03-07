@extends('layouts.primary')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('partials.admin-message')
        <form  action="{{ route('dashboard.donors.postDonate') }}" method="POST">
                @csrf

                <div class="card">
                <div class="card-header btn-default">
                    <h4 class="modal-title">
                        Please make the payment using QR Scan
                        <!-- You will be using RMA paymentway to make donation. It will work only for Bhutanese who have accounts with the Banks. -->
                    </h4>
                </div>

                    <div class="card-body">

                        <div class="form-group">
                            <span for="project_id">Select Project</span>
                            <select name="project_id" class="form-control" required>
                            @foreach ($projects as $p)
                                <option value="{{$p->id}}">{{ $p->name}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <span for="amount">Donation Amount</span>
                            <input type="number" class="form-control" placeholder="Enter the amount to donate" name="amount" required/>
                        </div>

                        <div class="form-group">
                            <span for="qr">Scan QR</span>
                            <img src="{{ asset('images/qrcode.jpeg') }}" width="180" />
                        </div>

                        <div class="form-group">
                            <span for="project_id">Bank</span>
                            <select name="bank" class="form-control" required>
                                <option value="BOB">Bank of Bhutan</option>
                                <option value="BNB">Bhutan National Bank Ltd</option>
                                <option value="TBANK">T Bank Ltd</option>
                                <option value="BDBL">Bhutan Development Bank Ltd.</option>
                                <option value="PNB">Druk PNB Ltd</option>
                                <option value="DK">DK</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <span for="amount">QR Journal ID</span>
                            <input type="text" class="form-control" placeholder="Enter the Jrn number after payment using QR" name="jrn" required/>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn bg-dark text-white">
                                {{ __('Submit') }}
                            </button>

                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger" data-dismiss="modal" aria-span="Close">
                                Cancel
                            </a>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
