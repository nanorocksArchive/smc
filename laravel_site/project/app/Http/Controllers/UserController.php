<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller {

    public function postSingUp(Request $request)
    {

        $this->validate($request,[
            'firstname'=> 'required|max:30',
            'email'=> 'required|email|unique:users| ',
            'password'=>'required|min:8'
        ]);

        $firstname = $request['firstname'];
        $email = $request['email'];
        $password = bcrypt($request['password']);


        $user = new User();
        $user->firstname = $firstname;
        $user->email = $email;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        return redirect()->to('dashboard');
    }
    public function postSingIn(Request $request){

        $this->validate($request,[
            'email'=> 'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
            return redirect()->to('dashboard');
        }
        else
        {
          return redirect()->back();
        }
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->to('/');

    }

    public function getAccountUser()
    {
        if(!Auth::user())
        {
            return redirect('/dashboard');
        }
        return view('account')->with('user',Auth::user());

    }
    public function postAccountUser(Request $request)
    {
        $this->validate($request,[
            'firstname'=> 'required',
        ]);
        $user = Auth::user();
        $user->firstname = $request['firstname'];
        $user->update();


        $file = $request->file('image');
        $file_name = $request['firstname'] . '-' .$user->id .'.jpg';
        if($file)
        {
           $img=Storage::disk('local')->put($file_name,File::get($file));
        }
        return redirect()->to('/account');
    }

    public function getUserImage($filename)
    {
        $img = $filename . '.jpg';
        $storagePath = storage_path('app/'.$img);

        if( file_exists( $storagePath ) )
        {
            //Send the file to console once authorized
            $file_contents = file_get_contents( $storagePath );
            return response()->make($file_contents, 200, [
                'Content-Type' => 'application/image',
                'Content-Disposition' => 'inline; filename="'.$img.'"'
            ] );
        }
    }


    public function postUserLike(Request $request)
    {
        $post_id = $request['post_id'];
        $like = $request['like'];
        $user = Auth::user()->id;

        if($like == 0)
        {
            Like::where(['like'=>1,'user_id'=>$user,'post_id'=>$post_id])->delete();
            return response('Success!!',200);
        }
        $newlike = new Like();
        $newlike->user_id = $user;
        $newlike->post_id = $post_id;
        $newlike->like = $like;

        $newlike->save();

        return response('Success!!',200);

    }
}



