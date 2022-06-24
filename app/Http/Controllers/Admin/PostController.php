<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderByDesc('id')->get();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* TODO: Validate Tags */
          // Validate data
          $val_data = $request->validated();
          // Gererate the slug
          $slug = Post::generateSlug($request->title);
          $val_data['slug'] = $slug;
  
          // create the resource
          $new_post = Post::create($val_data);
          $new_post->tags()->attach($request->tags);
          // redirect to a get route
          return redirect()->route('admin.posts.index')->with('message', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // dd($categories, $post);
        $tags = Tag::all();
/*         $data = [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()

        ]; */
        
        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //dd($request->all());

        // validate data
        $val_data = $request->validated();
        //dd($val_data);


        // Gererate the slug
        $slug = Post::generateSlug($request->title);
        //dd($slug);
        $val_data['slug'] = $slug;
        // update the resource
        $post->update($val_data);

        // Syncs Tags
        $post->tags()->sync($request->tags);

        // redirect to get route
        return redirect()->route('admin.posts.index')->with('message', "$post->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted successfully");
    }
}
