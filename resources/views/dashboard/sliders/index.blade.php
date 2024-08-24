@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])

@section('content')

@include('partials.admin-message')

<div class="card">

    <div class="card-header">{{ __('Slider Photo Management') }}
        <a class="btn bg-dark text-white float-right" data-toggle="modal" id="userButton" data-target="#userModal" data-attr="{{ route('dashboard.sliders.create') }}" title="Upload"> <i class="fas fa-plus-circle"></i> Upload Slider Image</a>
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-sm">
            <thead class="thead-light">
                <tr class="bg-info text-light">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            @forelse ($sliders as $i =>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $item->title}}</td>
                    <td>
                    <img src="{{url('uploads/sliders/',$item->filename)}}" alt="{{ $item->title}}" style="width:100px;"/>

                    </td>
                    <td>
                        <form action="{{ route('dashboard.sliders.destroy', $item->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>

                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center text-muted py-3">No record Found</td>
                    </tr>
            @endforelse
        </table>
    </div>
</div>

 <!-- modal -->
<div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="postLabelBody" aria-hidden="true">
    <div class="modal-dialog content modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="userBody">
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/js/jquery.min.js')}}"></script>

<script>
    $(document).on('click', '#userButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(result) {
                $('#userModal').show();
                $('#userBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            },
            timeout: 8000
        })
    });
</script>
@endsection

