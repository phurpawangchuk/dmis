@extends('layouts.model')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Select your supervisor or head') }}</div>
    <div class="card-body">
    <form method="POST" action="{{ route('admin.users.updatehead') }}">
        @csrf
        <input type="hidden" value="{{ $user->id }}" name="user_id">
        <table class="table table-responsive-sm table-bordered table-sm">
            <tr class="bg-info text-light"><th>Select</th><th>Name</th><th>Division</th></tr>
            @foreach($userList as $i=>$u)
            <tr>
                <td>
                @if($u->id == $headId)
                    <input type="radio" name="users[]" value="{{ $u->id }}" checked> 
                @else 
                    <input type="radio" name="users[]" value="{{ $u->id }}"> 
                @endif
                </td>
                <td>
                    {{ $u->name}}
                </td>
                <td>
                    {{ $u->divisioncategory->divisionName ?? "-" }}
                </td>
            </tr>
            @endforeach
        </table>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Add Supervisor') }}
                </button>

                <button type="submit" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection
