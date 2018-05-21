<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index(){
        $forums = Forum::with(['replies', 'posts'])->paginate(4);
        return view('forums.index' , [
            'forums' => $forums
        ]);
    }

    public function show(Forum $forum){
        $posts = $forum->posts()->with(['owner', 'categories'])->paginate('4');
        $categories = Category::pluck('name' , 'id');
        return view('forums.detail' , compact('forum' , 'posts' , 'categories'));
    }

    public function store(Forum $forum){
        $this->validate(request() , [
            'name' => 'required|max:100',
            'description' => 'required|max:500'
        ]);
        Forum::create(request()->all());
        return back()->with('message' , ['success' , __("Foro creado correctamente")]);
    }
}
