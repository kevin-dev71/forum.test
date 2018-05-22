<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index() {
        $forums = Forum::search();
        return view('forums.index', compact('forums'));
    }

    public function show(Forum $forum) {
        $posts = $forum->posts()->with(['owner', 'categories'])->paginate(2);

        $categories = Category::pluck('name', 'id');

        return view('forums.detail', compact('forum', 'posts', 'categories'));
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|max:100|unique:forums',
            'description' => 'required|max:500',
        ]);
        Forum::create(request()->all());
        return back()->with('message', ['success', __("Foro creado correctamente")]);
    }

    public function search() {
        if(request()->isMethod('POST')) {
            $search = request('search');
            if($search) {
                request()->session()->put('search', $search);
                request()->session()->save();
            } else {
                request()->session()->forget('search');
            }
        }
        return redirect('/');
    }

    public function clearSearch() {
        request()->session()->forget('search');
        return back();
    }
}
