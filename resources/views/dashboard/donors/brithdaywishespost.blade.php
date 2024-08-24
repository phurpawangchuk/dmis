@extends('layouts.model')

@section('content')
<div class="card">
    <div class="modal-header btn-default">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card-body">
        <form method="POST" id="comment_form">
            @csrf
             <div class="form-group row">
                <span for="event_name" class="required col-md-4 col-form-span">Birthday wishese</span>
                <div class="col-12">
                <input type="hidden" class="form-control" id="id" value="{{ $user->id}}">
                <input type="hidden" class="form-control" id="email" value="{{ $user->email}}">
                    <input type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                </div>
            </div>

            <div class="form-group row">
                <span for="description" class="required col-md-4 col-form-span">Wishes</span>
                <div class="col-12">
                <input type="text" class="form-control" id="wishes" value="" required>
                </div>
            </div>
             
                     
            <div class="form-group row mb-0">
                <div class="col-12 offset-md-4">
                    <button type="button" class="btn btn-primary" id="btn">
                        Post
                    </button>

                    <button type="submit"  class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> 
<script src="{{asset('/js/jquery.min.js')}}"></script>
<script>

$('#btn').on('click', function(event){
  event.preventDefault();
  ///alert($('#id').val());
 var id=$('#id').val();
  if($('#id').val() != '' && $('#name').val() != ''&&$('#email').val() != '' && $('wishes').val() != '')
  {
   
   $.ajax({
    url:"{{url('admin/nocup')}}",
   method:"POST",
   data:{id:$('#id').val(),name:$('#name').val(),email:$('#email').val(),wish:$('#wishes').val(),_token: '{{csrf_token()}}'},
   dataType:"json",
    success:function(data)
    {
        alert(data);
    // $('#comment_form')[0].reset();
       
    
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 
</script>



@endsection
