<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostsResource;
use App\Post;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index(Post $post) {
        return PostsResource::collection($post->paginate(2));
    }

    public function show(Post $post) {
        return new PostsResource($post);
    }
}
