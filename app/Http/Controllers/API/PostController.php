<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['tags', 'category'])->orderByDesc('id')->paginate(9);
        return $posts;
    }

    public function show($slug)
    {
        
        $post = Post::with(['tags', 'category'])->where('slug', $slug)->first();
        
        if ($post) {
            return $post;
        } else {
            return response()->json([
                'status' => 404,
                'status_text' => 'not found',
            ]);
            
        }
        
    }
}
