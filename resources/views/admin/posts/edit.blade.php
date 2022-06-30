@extends('layouts.admin')


@section('content')

<div class="container">
    <h2 class="py-4">Edit {{$post->title}}</h2>
    @include('partials.errors')
    <form action="{{route('admin.posts.update', $post->slug)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Learn php article" aria-describedby="titleHelper" value="{{old('title', $post->title)}}">
            <small id="titleHelper" class="text-muted">Type the post title, max: 150 carachters</small>
        </div>
        <!-- TODO: Change to input type file -->
        <div class="d-flex">
            <div class="media pr-4">
                <img class="shadow" width="150" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="cover_image">cover_image</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror" placeholder="Learn php article" aria-describedby="cover_imageHelper">
                <small id="cover_imageHelper" class="text-muted">Type the post cover_image</small>
            </div>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">
            {{old('content', $post->content)}}
            </textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Categories</label>
            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option value=""> Select Category:</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <select multiple class="form-control" name="tags[]" id="tags">
                <option value="" disabled>Select Tags</option>
                @forelse($tags as $tag)
                @if($errors->any())
                <option value="{{$tag->id}}" {{ in_array($tag->id, old('tags' ), []) ? 'selected' : '' }}> {{$tag->name}} </option>
                @else
                <option value="{{$tag->id}}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}> {{$tag->name}} </option>
                @endif
                
                
                @empty
                <option value="">No Tags</option>
                @endforelse

            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit Post</button>

    </form>

</div>




@endsection