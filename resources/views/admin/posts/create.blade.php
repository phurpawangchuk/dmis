@extends('layouts.model')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Add New Post') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="title" class="form-label">Title</label>
                <input value="{{ old('title') }}" 
                    type="text" 
                    class="form-control" 
                    name="title" 
                    placeholder="Enter Title" required>

                @if ($errors->has('title'))
                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="mb-2">
                <label for="description" class="required form-label">{{ __('Description') }}</label>

                <input value="{{ old('description') }}" 
                    type="text" 
                    class="form-control" 
                    name="description" 
                    placeholder="Enter Description">

                @if ($errors->has('description'))
                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save post</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Cancel</a>
        </form>
    </div>
</div>
@endsection