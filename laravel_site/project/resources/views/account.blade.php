@extends('../layouts/master')
@section('title')
    Account
@endsection
@section('content')
        <div class="row">
            <div class="col-sm-6">
                <h3>Your Account</h3>
                <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group {{$errors->has('firstname') ? 'has-error' : ''}}">
                        <label for="firstname" >Firstname</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{$user->firstname}}">
                    </div>
                    <div class="form-group">
                        <label for="firstname" >Upload image only .jpg format</label>
                        <input type="file" name="image" id="image" class="form-control" value="">
                    </div>
                    <button type="submit" class="btn-primary">Save changes</button>

                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>
            </div>
            @if(\Illuminate\Support\Facades\Storage::disk('local')->has($user->firstname.'-'.$user->id.'.jpg'))
                <section class="row new-post">
                    <div class="col-sm-6">
                        <img src="{{route('account.image',['filename'=>$user->firstname.'-'.$user->id])}}" class="img-responsive">
                    </div>
                </section>
    </div>


    @endif
@endsection