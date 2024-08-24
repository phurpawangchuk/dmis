@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'master'
])
@section('title','Donor Details')
@section('content')
@section('heading','Donor Details')


  <div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-warning">
            <div class="card-header text-right"><a href="/Documents/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Donor</a></div>
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
                        <th>Rank</th>
                         <th class="text-right">Action</th>
                    </tr>
                    <tr>
                        <td > Sonam Deki</td>
                        <td>11410007878</td>
                        <td>Research Officer</td>
                        <td>College of Science and Technology</td>
                        <td>sdecki@cst.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>1</td>
                        <td class="text-right">
                            <a href="#" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>


                        </td>
                    </tr>
                    <tr>
                        <td> Tashi Dorji</td>
                        <td>11410007878</td>
                        <td>Lecturer</td>
                        <td>Royal Thimphu College</td>
                        <td>Tashi@rtc.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>2</td>
                        <td class="text-right">
                            <a href="#" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>


                        </td>
                    </tr>

                    <tr>
                        <td> Tashi Dorji</td>
                        <td>11410007878</td>
                        <td>Lecturer</td>
                        <td>Royal Thimphu College</td>
                        <td>Tashi@rtc.bt</td>
                        <td>16524252</td>
                        <td>Bhutan</td>
                        <td>3</td>
                        <td class="text-right">
                            <a href="#" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="form-confirm btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>


                        </td>
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
