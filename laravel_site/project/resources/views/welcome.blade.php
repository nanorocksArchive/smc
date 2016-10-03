@extends('../layouts/master')

@section('title')
    wellcome page
@endsection


@section('content')

    <h3>Wellcome!!!</h3>
    <div class="row">
        <div class="col-sm-6">
            <h3>Sing up</h3>
            <form action="{{route('singup')}}" method="post">
                <div class="form-group {{$errors->has('firstname') ? 'has-error' : ''}}">
                    <label for="firstname" >Firstname</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{Request::old('firstname')}}">
                </div>
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="email" >E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for="password" >Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{Request::old('password')}}">
                </div>
                <button type="submit" class="btn-primary">Submit</button>

                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>

        <div class="col-sm-6">
            <h3>Sing in</h3>
            <form action="{{route('signin')}}" method="post">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="email" >E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{Request::old('email')}}" />
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for="password" >Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{Request::old('password')}}" />
                </div>
                <button type="submit" class="btn-primary">Submit</button>

                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </div>

    @include('../includes/message-block')

@endsection

