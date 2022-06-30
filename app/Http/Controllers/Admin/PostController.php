<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Mail\NewPostCreated;
use App\Mail\PostUpdateAdminMessage;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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

        // Verificare se la richiesta contiene un file

        // ddd(array_key_exists('cover_image', $request->all()))); // opzione 1 (Laravel)
        // ddd($request->hasFile('cover_image'));
        if ($request->hasFile('cover_image')) { // opzione 2 (PLain PHP)

            // valida file
            $request->validate(
                [
                    'cover_image' => 'nullable|image|max:5000' /// massimo 5000kbs
                ]
            );
            // salvanel fyle sytyem e recupero il percorso salvandolo in una variavìbile
            $path = Storage::put('post_images', $request->cover_image);
            // recuper percorso 
            $val_data['cover_image'] = $path;
            // passo il percoso all'array di dati validati per salvare i file nello sorage
        };

        // create the resource
        $new_post = Post::create($val_data);
        $new_post->tags()->attach($request->tags);
        dd($new_post);

        // visualizzazione anteprima
        // return (new NewPostCreated($new_post))->render();
        // invia email usendo istanza dell'utente nella request

        Mail::to($request->user())->send(new NewPostCreated($new_post));

        // invio ad email usando un email

        // Mail::to($request->user)->send(new NewPostCreated($new_post));

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
        return view('admin.posts.show', compact('post'));
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


        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        // validate data
        $val_data = $request->validated();

        // Gererate the slug
        $slug = Post::generateSlug($request->title);
        
        $val_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) { // opzione 2 (PLain PHP)

            // valida file
            $request->validate(
                [
                    'cover_image' => 'nullable|image|max:5000' /// massimo 5000kbs
                ]
            );

            // Prima di aggiornare la img elimino quella vecchia per recuperare spazio
            Storage::delete($post->cover_image);
            // salvanelfyle system e recupero il percorso salvandolo in una variavìbile
            $path = Storage::put('post_images', $request->cover_image);
            // recuper percorso 

            $val_data['cover_image'] = $path;
            // passo il percoso all'array di dati validati per salvare i file nello sorage
        };

        // update the resource
        $post->update($val_data);

        // Syncs Tags
        $post->tags()->sync($request->tags);

        //dd($post);

        //return new PostUpdateAdminMessage($post);

        // return (new PostUpdateAdminMessage($post))->render();


        Mail::to('admin@boolpress.it')->send(new PostUpdateAdminMessage($post));

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
        Storage::delete($post->cover_image);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted successfully");
    }
}
