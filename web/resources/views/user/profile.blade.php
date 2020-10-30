@extends('layouts.app')

@section('Profile', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5">
        <div class="col-10 p-0 offset-1">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="font-weight-bolder">Profile</h2>
                    <form method="POST" action="{{ route('profile.update') }}" id="form-profile">
                        <div class="form-row">
                            <div class="form-group col-md-4 m-0">
                                <label for="name">Full name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name"
                                    required value="{{ Auth::user()->getName() }}">
                            </div>
                            <div class="form-group col-md-4 m-0">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{ Auth::user()->getEmail() }}">
                                @if (Session::has('errors'))
                                    <small id="emailMsg" class="form-text text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                            </div>
                            <div class="form-group col-md-4 m-0">
                                <div class="form-group">
                                    <label for="verify">Email verify</label>
                                    <input type="text" class="form-control" id="verify"
                                        value="{{ Auth::user()->getEmailVerify() }}" disabled>
                                    <span id="passMsg" class="small"></span>
                                </div>
                            </div>
                            <div class="form-group ml-1">
                                <button type="submit" class="btn btn-primary" onclick="updateProfile(event)">Update
                                    Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-10 p-0 offset-1 mt-5">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="font-weight-bolder">Change Password</h2>
                    <form method="POST" action="{{ route('profile.change.password') }}" id="change-password">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Current password</label>
                                <input type="password" class="form-control" id="password" name="password" required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="newPassword">New password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" min="8"
                                    required>
                            </div>
                            <div class="form-group ml-1">
                                <button type="submit" class="btn btn-primary" onclick="changePassword(event)">Change
                                    Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        var token =  document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function updateProfile(event) {

            event.preventDefault();

            let form = document.getElementById('form-profile');

            let url = form.action;

            let methodForm = form.method;

            let data = {
                'name': document.getElementById('name').value,
                'email': document.getElementById('email').value
            };

            fetch(url, {
                method: methodForm,
                headers: {
                    'x-csrf-token': token,
                    'accept': 'application/json',
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }))
            }).then(function (response) {
                Swal.fire(
                    response.status.toString(),
                    (response.status == 200) ? response.data.message : response.data.errors.email[0],
                    (response.status == 200) ? 'success' : 'error'
                );
            });
        }

        function changePassword(event) {

            event.preventDefault();

            let form = document.getElementById('change-password');

            let url = form.action;

            let methodForm = form.method;

            let data = {
                'password': document.getElementById('password').value,
                'newPassword': document.getElementById('newPassword').value
            };

            fetch(url, {
                method: methodForm,
                headers: {
                    'x-csrf-token': token,
                    'accept': 'application/json',
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }))
            }).then(function (response) {
                console.log(response);
                Swal.fire(
                    (response.data.errors != "true") ? response.status.toString() : "400",
                    (response.status == 200) ? response.data.message : response.data.errors.newPassword[0],
                    'info'
                );
            });
        }
    </script>
@endsection
