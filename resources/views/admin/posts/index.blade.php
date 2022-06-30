@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between py-4">
        <h1>All Posts</h1>
        <div><a href="{{route('admin.posts.create')}}" class="btn btn-primary">Add Post</a></div>
    </div>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Cover Image</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td scope="row">{{$post->id}}</td>
                <td>{{$post->title}}</td>
               
                <td><img class="img-fluid " src="{{ asset('/storage/' . $post->cover_image )}}" alt="cover of {{$post->title}}"></td>
                <td>{{Str::limit($post->content,150)}}</td>
                <td>
                    <p>{{(is_null($post->category))? 'Uncategorized' : $post->category->name}}</p>
                </td>

                <td>
                    <a class="btn btn-primary text-white btn-sm d-block mt-1" href="{{route('admin.posts.show', $post->slug)}}">View</a>
                    <a class="btn btn-secondary text-white btn-sm d-block mt-1" href="{{route('admin.posts.edit', $post->slug)}}">Edit</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm d-block mt-1" data-toggle="modal" data-target="#delete-post-{{$post->id}}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete {{$post->title}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete {{$post->title}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td scope="row">No Post Yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection