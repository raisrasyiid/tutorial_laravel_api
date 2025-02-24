<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        //menggunakan cara biasa 
        // return response()->json(['data' => $posts]);

        //menggunakan cara API collection
        return PostResource::collection($posts);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        //menggunakan "new" jika ingin menampilkan data detail (1 data saja)
        return new PostDetailResource($post);
    }
}
