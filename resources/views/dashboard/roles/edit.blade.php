@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="modal-title">{{ __('Edit Role') }}</h4>
    </div>

    <div class="container">
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="role_name" class="col-md-12 font-16">{{ __('Role') }}</label>

                    <div class="col-md-12">
                        <input id="text" type="role_name" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="{{ old('role_name', $role->role_name) }}" required autocomplete="role_name">

                        @error('role_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="short_code" class="col-md-12 font-16">{{ __('Short Code') }}</label>

                    <div class="col-md-12">
                        <input id="text" type="short_code" class="form-control @error('short_code') is-invalid @enderror" name="short_code" value="{{ old('short_code', $role->short_code) }}" autocomplete="short_code">

                        @error('short_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permissions" class="col-md-12 font-16">{{ __('Permissions') }}</label>

                    <div class="col-md-12" id="permissions-select">
                        <select name="permissions[]" id="permissions" class="@error('permissions') is-invalid @enderror"  multiple>
                            @foreach ($permissions as $id => $permission)
                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permission }}</option>
                            @endforeach
                        </select>
                        <a href="#" id="permission-select-all" class="btn btn-link">select all</a>
                        <a href="#" id="permission-deselect-all" class="btn btn-link">deselect all</a>

                        @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
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
</div>

<script>
    var permission_select = new SlimSelect({
        select: '#permissions-select select',
        //showSearch: false,
        placeholder: 'Select Permissions',
        deselectLabel: '<span>&times;</span>',
        hideSelectedOption: true,
    })

    $('#permissions-select #permission-select-all').click(function(){
        var options = [];
        $('#permissions-select select option').each(function(){
            options.push($(this).attr('value'));
        });

        permission_select.set(options);
    })

    $('#permissions-select #permission-deselect-all').click(function(){
        permission_select.set([]);
    })
</script>
