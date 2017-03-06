<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $posts, User $users)
    {
        $users = User::all();
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    public function newPost(Request $request, Post $new_post)
    {
        $new_post = new Post;
        $new_post->post_by = $request->user_id;
        $new_post->post_content = $request->new_post;
        $new_post->save();


        Session::flash('post-flash', ' thanks for posting your updates ');
        return back();

    }
}
