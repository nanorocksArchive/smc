@extends('layouts.app')

@section('Login', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5 mt-5">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2">

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('login.user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember_token" name="remember_token"
                                checked value="1">
                            <label class="form-check-label" for="remember_token">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    {{-- @if (Session::has('login'))
                        <div class="alert {{ Session::get('login.icon') }} mt-3 alert-dismissible fade show" role="alert">
                            {{ Session::get('login.msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif --}}
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
    @if (Session::has('login'))
        Swal.fire(
            "{{ Session::get('login.title') }}",
            "{{ Session::get('login.msg') }}",
            "{{ Session::get('login.icon') }}"
        );
    @endif
</script>
@endsection
