<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('user.dashboard', compact('posts'));
    }

    /**
     * authUserPosts
     *
     * @return void
     */
    public function authUserPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()->paginate(6);
        return view('user.dashboard', compact('posts'));
    }


    /**
     * createPost
     *
     * @param  mixed $request
     * @return void
     */
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'post' => 'required|min:20|max:1000'
        ]);

        $post = new Post();
        $post->body = $request['post'];
        $post->user_id = Auth::user()->id;
        $success = $post->save();

        $msg = 'Post not created';
        $title = 'Oops...';
        $icon = 'error';

        if ($success) {
            $msg = 'Post successful created!';
            $title = 'Yay...';
            $icon = 'success';
        }

        $request->session()->flash('dashboard', ['icon' => $icon, 'title' => $title, 'msg' => $msg]);

        return redirect('dashboard');
    }

    /**
     * deletePost
     *
     * @param  mixed $request
     * @return void
     */
    public function deletePost(PostRequest $request)
    {
        $post = Post::where('id', $request->id)->first();

        $post->delete();

        return [
            'error' => false,
            'message' => 'Successful deleted post',
            'status' => 1,
        ];

    }

    /**
     * editPost
     *
     * @param  mixed $request
     * @return void
     */
    public function editPost(PostRequest $request)
    {
        $this->validate($request, [
            'post' => 'required|min:20|max:1000'
        ]);

        $post = Post::find($request['id']);
        $post->body = $request['post'];
        $post->update();

        return [
            'error' => false,
            'message' => 'Successful updated post',
            'status' => 1,
        ];
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
