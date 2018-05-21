<?php

namespace App\Http\Controllers\Api;

use App\Forum;
use App\Http\Resources\ForumsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumsController extends Controller
{
    public function index(Forum $forum) {
        return ForumsResource::collection($forum->with('posts')->paginate(2));
    }

    public function show(Forum $forum) {
        return new ForumsResource($forum->with('posts')->first());
    }
}
