<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Rules\ValidReply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['store' , 'destroy']);
    }

    public function store(){
        $this->validate(request() , [
            'reply' => ['required' , new ValidReply],
            'file' => 'image'
        ]);

        if(request()->hasFile('file') && request()->file('file')->isValid() ){
            $filename = uploadFile('file' , 'replies');
            request()->merge(['attachment' => $filename]);
        }

        Reply::create(request()->input());

        return back()->with('message' , ['success' , __('Respuesta añadida correctamente')]);
    }

    public function destroy(Reply $reply) {
        $reply->delete();
        return back()->with('message', ['success', __('Respuesta Eliminada Correctamente')]);
    }
}
