@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'myapplication'
])
@section('title','My Applications')
@section('content')
@section('heading','My Applications')
@include('partials.admin-message')

  <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-striped">
                    <tr>
                        <th>Sl No</th><th>Applied on</th><th>Status</th><th>Scholarship Title</th><th>Type</th><th>Fund</th><th></th>
                    </tr>
                    @foreach ($applications as $application)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{\Carbon\Carbon::parse($application->created_at)->format('d-m-Y')}}</td>
                        <td><span class="badge bg-success">{{$application->status}}</span></td>
                        <td>{{$application->scholarship->name}}</td>
                        <td>{{$application->scholarship->type}}</td>
                        <td>{{$application->scholarship->scholarshipsponser->sum('fund')}}</td>
                        <td>
                            @if($application->status=="Approved")
                            <span class="btn btn-dark btn-xs"><i class="fa fa-ban"></i> Withdraw</span>
                            @else
                            <a href="{{route('applications.withdrawApplication',$application->id)}}" class="withdraw btn btn-xs btn-primary"><i class="fa fa-times"> Withdraw</i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>   
        </div>
    </div>

   
</div>    
@endsection

@push('scripts')
<script>
    $(function(){

            $('.withdraw').on('click', function (e) {
            e.preventDefault();
            href = $(this).attr('href');
            return bootbox.confirm('Are you sure you want to withdraw this scholarship?', function(result) {
            if (result) {
                window.location = href
            }
            });
        });
         
    });
</script>
@endpush