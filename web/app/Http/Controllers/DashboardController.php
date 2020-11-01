<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
       // dd($posts);
        return view('user.dashboard', compact('posts'));
    }

    /**
     * authUserPosts
     *
     * @return void
     */
    public function authUserPosts()
    {
        $posts = Auth::user()->posts;
        return view('user.dashboard', compact('posts'));
    }


    public function postCreatePost(Request $requests)
    {
        $this->validate($requests, [
            'body' => 'required|min:20'

        ]);

        $post = new Post();
        $post->body = $requests['body'];
        $post->user_id = Auth::user()->id;
        $succ = $post->save();
        $message = 'We have an error.';
        if ($succ) {
            $message = 'Post Successfull created!';
        }

        return redirect()->to('/dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }

        $post->delete();
        return redirect()->to('dashboard')->with('message', 'Succesfull deleted post');
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:20'
        ]);

        $post = Post::find($request['id']);
        $post->body = $request['body'];
        $post->update();

        return response()->json(['message' => 'Post edited!', 200]);
    }

    /**
     * toggleLike
     *
     * @param  mixed $request
     * @return void
     */
    public function toggleLike(Request $request)
    {
        $post_id = $request['post_id'];
        $like = $request['like'];
        $user = Auth::user()->id;

        if ($like == 1) {
            Like::where(['like' => 1, 'user_id' => $user, 'post_id' => $post_id])->delete();

            $total = Post::find($post_id)->likes()->count();

            return [
                'error' => false,
                'message' => 'Like',
                'status' => 0,
                'total' => $total
            ];
        }

        $like = new Like();
        $like->user_id = $user;
        $like->post_id = $post_id;
        $like->like = 1;

        $like->save();

        $total = Post::find($post_id)->likes()->count();

        return [
            'error' => false,
            'message' => 'You add like on post',
            'status' => 1,
            'total' => $total
        ];
    }


}
