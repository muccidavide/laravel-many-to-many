@extends('layouts.admin')

@section('content')
dd($content)
<div class="container">
  <h2 class="py-4">Create a new Post</h2>
  @include('partials.errors')
  <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Learn php article" aria-describedby="titleHelper" value="{{old('title')}}">
      <small id="titleHelper" class="text-muted">Type the post title, max: 150 carachters</small>
    </div>
    <!-- TODO: Change to input type file -->
    <div class="form-group">
      <label for="cover_image">cover_image</label>
      <input type="file" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror"  placeholder="Learn php article" aria-describedby="cover_imageHelper">
      <small id="cover_imageHelper" class="text-muted">Type the post cover_image</small>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">
      {{old('content')}}
      </textarea>
    </div>
    <div class="form-group">
      <label for="category_id">Categories</label>
      <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
        <option value=""> Select Category:</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{ $category->id == old('category->id') ? 'selected' : '' }} >{{$category->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="tags">Tags</label>
      <select multiple class="form-control" name="tags[]" id="tags">
      <option value="" disabled>Select Tags</option>
        @forelse($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->name}}</option>
        @empty
        <option value="">No Tags</option>
        @endforelse

      </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Post</button>

  </form>

</div>


@endsection