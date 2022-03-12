@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('View Post') }}</div>

        <div class="card-body">

            <a href="{{ route('admin.posts.index') }}" class="btn btn-light">Back to Post</a>

            <br /><br />



                <table class="table table-borderless">

                    <tr>
                        <th>ID</th>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $post->description }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>{{ $post->getAuthorName($post->author) ?? '--' }}</td>
                    </tr>

                </table>




        </div>
    </div>

@endsection
