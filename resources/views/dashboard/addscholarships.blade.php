@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'addschoolar'
])
@section('title','Add Events')
@section('content')
@section('heading','Add Events')

<form action="{{ route ('scholarships.scholarshipAdd')}}" method="post" class="form">
@csrf
@method('POST')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Event Title</label>
                    <input type="text" class="form-control form-control-sm" name="title" placeholder="Event Title" required>
                </div>

                <div class="form-group">
                    <label for="title">Event Description</label>
                    <textarea class="form-control" rows="4" name="description" placeholder="Scholarship Description" required></textarea>
                </div>


            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body">


                <div class="form-group">
                    <label for="title">Date</label>
                    <div class="input-group">
                            <input type="text" id="opendate" class="form-control form-control-sm" name="opendate" readonly  required >
                        <div class="input-group-append">
                            <span class="input-group-text form-control-sm"><i class="fas fa-calendar-check fa-xs"></i></span>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer text-right">
            <button class="btn btn-sm btn-primary" id="submitforms"> Add Event</button>
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
