@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Donation History')
@section('content')
@section('heading','Donation History')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">

            @include('partials.admin-message')
            <div class="card-body table-responsive p-0">
                <table class="table table-nowrap table-sm table-striped ">
                    <tr>
                        <th> Name</th>
                        <th>CID No.</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Country</th>
                        <th>Amount </th>
                        <th>Date </th>
                    </tr>
                    <tr>
                        <td > Sonam Deki</td>
                        <td>11410007878</td>
                        <td>Research Officer</td>
                        <td>College of Science and Technology</td>
                        <td>sdecki@cst.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>10,000</td>
                        <td>12/11/22</td>

                    </tr>
                    <tr>
                        <td> Tashi Dorji</td>
                        <td>11410007878</td>
                        <td>Lecturer</td>
                        <td>Royal Thimphu College</td>
                        <td>Tashi@rtc.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>20500</td>
                        <td>12/11/22</td>

                    </tr>

                    <tr>
                        <td> Tashi Dorji</td>
                        <td>11410007878</td>
                        <td>Lecturer</td>
                        <td>Royal Thimphu College</td>
                        <td>Tashi@rtc.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>3500</td>
                        <td>1/11/22</td>

                    </tr>
                    {{--  @foreach($getdocuments as $documents )
                    <tr>
                        <td>{{$documents->name}}</td>
                        <td>{{$documents->type}}</td>
                        <td>
                            @if($documents->is_required=='1')
                             <i class="fa fa-check"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{route('documents.edit',$documents->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if($documents->profiledocument->count()==0)
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                                <a data-form="#frmDelete-{{$documents->id}}" data-title="Delete Document- {{$documents->name}}" data-message="Are you sure you want to delete this document?"></a>
                            </a>

                            <form action="{{route('documents.destroy',$documents->id)}}" method="POST" id="{{ 'frmDelete-'.$documents->id }}">
                                @csrf

                                </form>
                            @else
                            <span class="btn btn-xs btn-dark"><i class="fa fa-ban"></i></span>
                            @endif







                        </td>
                    </tr>
                    @endforeach--}}
                </table>

            </div>
        </div>

    </div>


</div>


@include('partials.confirm-delete')
@endsection
