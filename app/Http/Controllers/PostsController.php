<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post){
        $replies = $post->replies()->with('author')->paginate(4);

        return view('posts.detail' , [
            'post' => $post,
            'replies' => $replies
        ]);
    }

    public function store(PostRequest $post_request){

        if($post_request->hasFile('file') && $post_request->file('file')->isValid() ){
            $filename = uploadFile('file' , 'posts');
            $post_request->merge(['attachment' => $filename]);
        }

        Post::create($post_request->input()); // el user id se esta anadiendo automaticamente en el modelo con boot

        return back()->with('message' , ['success' , __("Post creado correctamente")]);
    }

    public function destroy(Post $post) {
        if( ! $post->isOwner())
            abort(401);

        $post->delete();
        return back()->with('message', ['success', __('Post y respuestas eliminados correctamente')]);
    }


}
