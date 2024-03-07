@extends('layouts.model')

@section('content')
<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title">{{ __('Edit Event') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.events.update', $event->id) }}">
            @csrf
             <div class="form-group row">
                <span for="event_name" class="required col-md-4 col-form-span">{{ __('Event Name') }}</span>
                <div class="col-12">
                    <input type="text" class="form-control" name="event_name" value="{{ old('event_name', $event->event_name) }}" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="description" class="required col-md-4 col-form-span">{{ __('Event Description') }}</span>
                <div class="col-12">
                <textarea class="form-control" name="description" id="description" required>{{ $event->description}}</textarea>
                </div>
            </div>
             
            <div class="form-group">
                    <label for="inputEmail3">Date</label>
                    <select class="form-control form-control-sm" name="Date" required>
                        <?php $date=explode("-",$event->event_date)?>
                        <option value="{{$date[2]}}">{{$date[2]}}</option>
                        
                        <?php for($i=1;$i<32;$i++){ ?>
                        <option value="{{$i}}">{{$i}}</option>
                        
                        <?php }  ?>
                    </select>
            </div>
            <div class="form-group">
                    <label for="inputEmail3">Month</label>
                    <select class="form-control form-control-sm" name="month" required>
                        <option value="{{$date[1]}}">
                        @foreach (config('setting.month') as $key => $value)
                                   @if($key==$date[1])
                                        {{$value}}
                                   @endif
                        
                        @endforeach

                        </option>
                        
                        @foreach (config('setting.month') as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <label for="inputEmail3">Year</label>
                    <select class="form-control form-control-sm" name="year" required>
                        <option value="{{$date[0]}}">{{$date[0]}}</option>
                        
                        <?php for($i=date("Y");$i>1930;$i--){ ?>
                        <option value="{{$i}}">{{$i}}</option>
                        
                        <?php }  ?>
                    </select>
            </div>
           
            <div class="form-group row mb-0">
                <div class="col-12 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>

                    <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> 

<script>
    $(function () {

        $('#agency_id').change(function(){
            var agencyID = $(this).val();
            $.ajax({
                type: "GET",
                url:  "{{url('util/getDepartments')}}?agency="+agencyID,
                success:function(res){
                        if(res){
                            $("#dept_id").empty();
                            $("#dept_id").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#dept_id").append('<option value="'+value.id+'">'+value.departmentName+'</option>');
                            });
                        }
                } //success
            });
        });

        $('#dept_id').change(function(){
            var deptID = $(this).val();
            $.ajax({
                type: "GET",
                url:  "{{url('util/getDivisions')}}?department="+deptID,
                success:function(res){
                        if(res){
                            $("#division_id").empty();
                            $("#division_id").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#division_id").append('<option value="'+value.id+'">'+value.divisionName+'</option>');
                            });
                        }
                } //success
            });
        });
    });
</script>

@endsection
