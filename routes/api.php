<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// tutti posts con respodse json costumizzabile (puoi fare paginate anche qui)

/* Route::get('posts', function(){

        $posts = Post::all();
        return response()->json([
                'status_code' => 200,
                'posts' => $posts
        ]);
}); */


// risultati no personalizzabili

/* Route::get('posts', function(){

    $posts = Post::all();
    return $posts;
}); */

// impaginare elementi (10 elementi per pagina)

/* Route::get('posts', function(){

    $posts = Post::paginate(10);
    return $posts;
});  */

// scorciatoia con relazione
/* Route::get('posts', function(){

    $posts = Post::with(['tags', 'category'])->get();
    return $posts;
});  */

// scorciatoia con relazione + paginazione
Route::get('posts','API\PostController@index'); 
Route::get('posts/{post:slug}','API\PostController@show'); 

Route::get('categories', 'API\PostController@index');
