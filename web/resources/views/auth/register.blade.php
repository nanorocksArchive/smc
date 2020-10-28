@extends('layouts.app')

@section('Register', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2">

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('register.user') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name"
                                required value="Andrej Nankov">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                                required value="andrejnankov@gmail.com" onfocus="document.getElementById('emailMsg').classList.add('d-none');">
                                @if(Session::has('errors'))
                                    <small id="emailMsg" class="form-text text-danger">{{ $errors->first('email') }}</small>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                onkeyup="passwordMatch(); passwordLength()" min="8" value="nanorocks123" onfocus="document.getElementById('passwordMsg').classList.add('d-none');">
                                <span id="passMsg" class="small"></span>
                                @if(Session::has('errors'))
                                    <small id="passwordMsg" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm" name="confirm" required
                                onkeyup="passwordMatch();" min="8" value="nanorocks123">
                            <span id="confMsg" class="small"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                </div>
            </div>

            <p class="text-center pt-4 pb-5 font-italic text-muted h6">
                S.M.C or social-media-center is a social network for internal communication between friends and colleagues.
                And it's developed for testing purposes, to try new features of Laravel 8. By nanorocks
            </p>
        </div>
    </div>
@endsection
@section('js')
    <script>
        @if(Session::has('register'))
            Swal.fire(
                "{{ Session::get('register.title') }}",
                "{{ Session::get('register.msg') }}",
                "{{ Session::get('register.icon') }}"
            );
        @endif


        function passwordLength() {
            let pass = document.getElementById('password').value;

            if (pass.length < 8) {
                document.getElementById('passMsg').style.color = 'red';
                document.getElementById('passMsg').innerHTML = 'password under 8 characters';
                return;
            }

            document.getElementById('passMsg').style.color = 'green';
            document.getElementById('passMsg').innerHTML = 'password is okay';
        }

        function passwordMatch() {
            let pass = document.getElementById('password').value;

            let conf = document.getElementById('confirm').value;

            if (pass == conf) {
                document.getElementById('confMsg').style.color = 'green';
                document.getElementById('confMsg').innerHTML = 'matching';
                return;
            }

            document.getElementById('confMsg').style.color = 'red';
            document.getElementById('confMsg').innerHTML = 'not matching';

        }

    </script>


@endsection
