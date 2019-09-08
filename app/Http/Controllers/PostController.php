<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use  App\Post;

class PostController extends Controller
{
    public function post(){

        $posts =Post::orderBy('created_at','desc')->get();

        return view('allpost')->with('posts',$posts);
    }

}
