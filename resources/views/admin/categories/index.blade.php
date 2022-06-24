@extends('layouts.admin')

@section('content')


@include('partials.session_message')
@include('partials.errors')
<div class="container">
    <h1 class="my-3">All Categories</h1>

    <div class="row">
        <div class="col">
            <form action="" method="post" class="d-flex align-center">
                @csrf
                <div class="input-group mb-3">
                    <input name="name" type="text" class="form-control" placeholder="front-end" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                    @forelse($cats as $category)
                    <tr>
                        <td scope="row">{{$category->id}}</td>
                        <td>
                            <form id="category-{{$category->id}}" action="{{route('admin.categories.update', $category->slug)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{$category->name}}">
                            </form>
                        </td>
                        <td>{{$category->slug}}</td>
                        <td><span class="badge badge-dark">{{count($category->posts)}}</span></td>
                        <td>
                            <button form="category-{{$category->id}}" type="submit" class="btn btn-primary btn-sm">Update</button>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#delete-{{$category->id}}">
                              Delete
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="delete-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete {{$category->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete {{{$category->name}}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{route('admin.categories.destroy', $category->slug)}}" method="post">
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
                    <td>No category found!</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection