@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Posts Verifier') }}</div>

        <div class="card-body">
            @can('post_create')
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New Post</a>
            @endcan
                <table class="table table-borderless table-hover">
                            <tr class="bg-info text-light">
                                <th class="text-center">ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="text-center">{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->getAuthorName($post->author) ?? "--"}}</td>
                            <td>
                                    @can('post_show')
                                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-success">Show</a>
                                    @endcan
                                    @can('post_edit')
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan
                                    @can('post_delete')
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted py-3">No Posts Found</td>
                            </tr>
                    @endforelse
                </table>

            @if($posts->total() > $posts->perPage())
                {{$posts->links()}}
            @endif

        </div>
    </div>

@endsection
