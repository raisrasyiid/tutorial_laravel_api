<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        return PostDetailResource::collection($posts->loadMissing('writer:id,username'));
    }

    public function show($id){
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($post);
    }

    public function showDetailWithOutWriter($id){
        $post = Post::findOrFail($id);
        return new PostDetailResource($post);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'news_content' => ['required'],
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());

        return response()->json([
            'status' => 'upload post successfully',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username'))
        ], 200);
    }

    public function update(Request $request, $id){

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'news_content' => ['required'],
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json([
            'status' => 'update data post successfully',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username'))
        ], 200);
    }

    public function destroy($id){

        $post= Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'status' => 'delete data successfully',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username'))
        ], 200);

    }
}