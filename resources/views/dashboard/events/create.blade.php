@extends('layouts.model')

@section('content')

<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{  $title }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.events.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <span for="event_name" class="required col-md-4 col-form-span">{{ __('Event Name') }}</span>
                <div class="col-12">
                    <input type="text" class="form-control" name="event_name" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="description" class="required col-md-4 col-form-span">{{ __('Event Description') }}</span>
                <div class="col-12">
                <textarea class="form-control" name="description" id="description" required></textarea>
                </div>
            </div>
            <div class="form-group">
                    <label for="inputEmail3">Date</label>
                    <select class="form-control form-control-sm" name="Date" required>
                        <option value="">--SELECT Day--</option>
                        
                        <?php for($i=1;$i<32;$i++){ ?>
                        <option value="{{$i}}">{{$i}}</option>
                        
                        <?php }  ?>
                    </select>
            </div>
            <div class="form-group">
                    <label for="inputEmail3">Month</label>
                    <select class="form-control form-control-sm" name="month" required>
                        <option value="">--SELECT Month--</option>
                        
                        @foreach (config('setting.month') as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <label for="inputEmail3">Year</label>
                    <select class="form-control form-control-sm" name="year" required>
                        <option value="">--SELECT Year--</option>
                        
                        <?php for($i=date("Y");$i>1930;$i--){ ?>
                        <option value="{{$i}}">{{$i}}</option>
                        
                        <?php }  ?>
                    </select>
            </div>

            <div class="form-group row mb-0">
                <div class="col-12 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>

                    <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-span="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
@endsection
