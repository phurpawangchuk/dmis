@extends('layouts.model')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Edit Post') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input value="{{ $post->title }}" 
                        type="text" 
                        class="form-control" 
                        name="title" 
                        placeholder="Title" required>

                    @if ($errors->has('title'))
                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input value="{{ $post->description }}" 
                        type="text" 
                        class="form-control" 
                        name="description" 
                        placeholder="Description">

                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
