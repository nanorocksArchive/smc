<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class PostController extends Controller
{

    public function getDashboard()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(2);
        $nomessage = 'There are no posts.';
       // dd($posts->count());

        if($posts->count() > 0)
        {
            return view('dashboard')->with('posts',$posts);
        }else{
            return view('dashboard')->with('posts',null);
        }


    }

    public function postCreatePost(Request $requests)
    {
        $this->validate($requests,[
            'body'=>'required|min:20'

        ]);

        $post = new Post();
        $post->body = $requests['body'];
        $post->user_id = Auth::user()->id;
        $succ = $post->save();
        $message = 'We have an error.';
        if($succ)
        {
            $message = 'Post Successfull created!';
        }

        return redirect()->to('/dashboard')->with(['message'=>$message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id',$post_id)->first();
        if(Auth::user() != $post->user)
        {
            return redirect()->back();
        }

        $post->delete();
        return redirect()->to('dashboard')->with('message','Succesfull deleted post');
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request,[
            'body'=>'required|min:20'
        ]);

        $post = Post::find($request['id']);
        $post->body = $request['body'];
        $post->update();

        return response()->json(['message'=>'Post edited!',200]);
    }

}
