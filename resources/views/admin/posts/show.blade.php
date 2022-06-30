@extends('layouts.admin')


@section('content')

<div class="posts d-flex p-4">
    <img class="img-fluid h-50" src="{{asset('/storage/' . $post->cover_image)}}" alt="{{$post->title}}">

    <div class="post-data px-4">
        <h1>{{$post->title}}</h1>
        <div class="content">
            {{$post->content}}

            <div class="categoty">
                Category : {{$post->category ? $post->category->name : 'Uncategorized'}}
            </div>
            <div class="tags">
                @if(count($post->tags) > 0)
                    @foreach($post->tags as $tag)
                    <span>{{$tag->name}}</span>
                    @endforeach
                @else
                <span>N/A</span>
                @endif
            </div>
        </div>
        <div class="actions mt-2">
            <a class="btn btn-primary btn-lg" href="{{route('admin.posts.edit', $post->slug)}}" role="button">Edit</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#delete-post-{{$post->id}}">
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

        </div>
    </div>
</div>


@endsection