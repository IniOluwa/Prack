<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Images;
use Session;
use DB;


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
        $images = Images::all();
        $users = User::orderBy('id', 'desc')->with('posts')->get();
        $posts = Post::orderBy('id', 'desc')->get();

        return view('home', compact('users','posts','images'));
    }

    public function newPost(Request $request, Post $new_post, Images $image)
    {
        $this->validate($request, [
            'image' => 'mimes:jpeg,png'
        ]);
        
        //if image has file inside 
        if($request->hasFile('image'))
        {
            //upload file
            $image_destination  = 'images/post_images/';
            $images_filter_name = $request->file('image');
            $images_ext         = $images_filter_name->getClientOriginalExtension();
            $image_new_name     = "Prack - ".date("y-m-d h-i-s").".".$images_ext;
            $images_filter_name->move($image_destination, $image_new_name); //function move the uploaded images

            $new_image = new Images;
            $new_image->image_by   = $request->user_id;
            $new_image->image_name = $request->image = $image_new_name;
            $new_image->save();
        }

        $new_post = new Post;
        $new_post->user_id      = $request->user_id;
        $new_post->post_content = $request->new_post;
        $new_post->post_image   = $image_new_name;
        $new_post->save();  
        
        Session::flash('post-flash', ' 1 new post added !');
        return back();
    }
}


