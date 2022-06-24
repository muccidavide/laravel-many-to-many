@extends('layouts.admin')

@section('content')


@include('partials.session_message')
@include('partials.errors')
<div class="container">
    <h1 class="my-3">All Tags</h1>

    <div class="row">
        <div class="col">
            <form action="" method="post" class="d-flex align-center">
                @csrf
                <div class="input-group mb-3">
                    <input name="name" type="text" class="form-control" placeholder="front-end" aria-label="Add Tag" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Add</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col">
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Post Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <td scope="row">{{$tag->id}}</td>
                        <td>
                            <form id="tag-{{$tag->id}}" action="{{route('admin.tags.update', $tag->slug)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{$tag->name}}">
                            </form>
                        </td>
                        <td>{{$tag->slug}}</td>
                        <td><span class="badge badge-dark">{{count($tag->posts)}}</span></td>
                        <td>
                            <button form="tag-{{$tag->id}}" type="submit" class="btn btn-primary btn-sm">Update</button>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#delete-{{$tag->id}}">
                              Delete
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="delete-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete {{$tag->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete {{{$tag->name}}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{route('admin.tags.destroy', $tag->slug)}}" method="post">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <td>No Tag found!</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection