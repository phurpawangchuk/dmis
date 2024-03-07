@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'managescholar'
])
@section('title','Edit Scholarship')
@section('content')
@section('heading','Edit Scholarship')

<form action="{{ route ('scholarships.updateScholarship',$scholarship->id)}}" method="post" class="form">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-5">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Event Title</label>
                    <input type="text" class="form-control form-control-sm" name="title" placeholder="Scholarship Title" value="{{$scholarship->name}}" required>
                </div>

                <div class="form-group">
                    <label for="title">Event Description</label>
                    <textarea class="form-control" rows="4" name="description" placeholder="Scholarship Description" required>{{$scholarship->description}}</textarea>
                </div>


            </div>
        </div>
    </div>



    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-body">


                <div class="form-group">
                    <label for="title"> Date</label>
                    <div class="input-group">
                            <input type="text" id="opendate" class="form-control form-control-sm" value="{{$scholarship->open_date}}" name="opendate" readonly  required >
                        <div class="input-group-append">
                            <span class="input-group-text form-control-sm"><i class="fas fa-calendar-check fa-xs"></i></span>
                        </div>
                        </div>
                </div>




                <div class="form-group">
                    <label for="title">Status</label>
                    <select  id="" name="is_active" class="form-control form-control-sm">
                            <option value="1" {{($scholarship->is_active==1?"selected":"")}}>Active</option>
                            <option value="0" {{($scholarship->is_active==0?"selected":"")}}>Inactive</option>
                        </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body table-responsive">
                <div class="form-group">
                    <label for="title">Sponsor</label>
                    <select name="" id="sponser" class="form-control form-control-sm">
                                <option value="">--Select Sponsor--</option>
                                @foreach($sponsers as $sponser)
                                    <option value="{{$sponser->id}}">{{$sponser->name}}</option>
                                @endforeach
                            </select>
                </div>

                <div class="form-group">
                    <label for="title">Fund</label>
                        <div class="col-sm-4">
                        <input type="number" id="fund" class="form-control form-control-sm" name="fund">
                        </div>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-sm btn-info add-row"><i class="fa fa-plus"></i> Add Sponsor</button>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Sponsor</th>
                        <th>Fund</th>
                        <th></th>
                    </tr>


                </thead>
                <tbody>
                @foreach($scholarship->scholarshipsponser as $ss)
                    <tr>
                        <td><input type="checkbox" name="record" id="record"></td>
                        <td>{{$ss->sponser->name}}</td>
                        <td>{{$ss->fund}}</td>
                        <td><input type="hidden" name="sponserfund[]" value="{{$ss->sponser->id}}-{{$ss->fund}}"></td>
                    </tr>


                    @endforeach

                </tbody>
        </table>
        <div class="text-right">
        <button type="button" class="delete-row btn btn-danger btn-sm"><i class="fa fa-times"></i> Remove Sponsor</button>
        </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer text-right">
            <button class="btn btn-sm btn-primary" id="submitform"> Update Scholarship</button>
            </div>
        </div>
    </div>
</div>

</form>
@endsection

@push('scripts')
<script src="{{ asset('js/relateddata.js') }}"></script>
<script>

var hideshow= function(){

    if($('#record').length==0)
        {
            $('.delete-row').hide();
            $('#submitform').prop('disabled', true);
        }
    else
        {
            $('.delete-row').show();
            $('#submitform').prop('disabled', false);
        }
}

    $(document).ready(function(){


        hideshow();


        $( "#opendate" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-20:+1",
          dateFormat: 'yy-mm-dd'
        });

        $( "#closedate" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-20:+1",
          dateFormat: 'yy-mm-dd'
        });
    });

    $(".add-row").click(function(){

            var name = $("#sponser option:selected").text();
            var sponser=$("#sponser").val();
            var email = $("#fund").val();

            if(sponser==""||email=="")
            {
                bootbox.alert("Please select Sponsor and enter the fund");

            }
            else
            {
                var markup = "<tr><td><input type='checkbox' name='record' id='record'></td><td>" + name + "</td><td>" + email + "</td><td><input type='hidden' name='sponserfund[]' value='" +sponser + "-"+email+"'></tr>";
                $("table tbody").append(markup);

                $("#fund").val('');
                $("#sponser").val('');


                hideshow();
            }

        });

        // Find and remove selected table rows
     $(".delete-row").click(function(){


            $("table tbody").find('input[name="record"]').each(function(){

            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                    hideshow();
                }
            });
        });


</script>
@endpush
