@extends('layouts.app')

@section('Dashboard', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5 mt-5">
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 offset-0 offset-sm-0 offset-md-1 offset-lg-1">
            <div class="row">
                @include('user.post.create')
                @if (empty($posts))
                    <div class="col-12 mt-5 p-4">
                        <div class="text-center text-muted">
                            <h1 class="font-weight-bolder">No posts yet. Be first one to write ti.</h1>
                        </div>
                    </div>
                @else
                    <div class="col-12 shadow mt-3 p-4 rounded-lg">
                        <div class="d-flex">
                            <h3 class="font-weight-bolder mb-0">Posts List</h3>
                            <div class="ml-auto">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle font-weight-bolder" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
                                        </svg>
                                        Filter
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a href="{{ route('dashboard') }}" class="dropdown-item" type="button">All Posts</a>
                                        <a href="{{ route('my.posts') }}" class="dropdown-item" type="button">My Posts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div id="post-container">
                            @foreach ($posts as $post)
                                @include('user.post.show')
                            @endforeach
                        </div>

                        {{ $posts->links('user.include.pagination') }}

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        @if (Session::has('dashboard'))
            Swal.fire(
                "{{ Session::get('dashboard.title') }}",
                "{{ Session::get('dashboard.msg') }}",
                "{{ Session::get('dashboard.icon') }}"
            );
        @endif

        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function toggleLike(self, url) {

            let postId = self.dataset.postId;

            let userId = self.dataset.userId;

            let likeStatus = self.dataset.likeStatus;

            let methodForm = 'POST';

            let data = {
                'like': likeStatus,
                'user_id': userId,
                'post_id': postId
            };

            fetch(url, {
                method: methodForm,
                headers: {
                    'x-csrf-token': token,
                    'accept': 'application/json',
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify(data)
            }).then(function(response) {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }))
            }).then(function(response) {
                // console.log(response);

                if (response.status != 200) {
                    Swal.fire(
                        response.status.toString(),
                        response.data.message,
                        (response.status == 200) ? 'success' : 'error'
                    );
                }

                let likeSelector = document.getElementById('like-' + postId);

                self.dataset.likeStatus = response.data.status;

                likeSelector.innerText = response.data.message;

                document.getElementById('likes-total-' + postId).innerText = response.data.total;

            });


        }

        function deletePost(id, url){

            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete the post!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {


                let postId = document.getElementById('post-' + id);

                let data = {
                    'id': id,
                };

                methodForm = 'POST'

                fetch(url, {
                    method: methodForm,
                    headers: {
                        'x-csrf-token': token,
                        'accept': 'application/json',
                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify(data)
                }).then(function(response) {
                    return response.json().then(data => ({
                        status: response.status,
                        data
                    }))
                }).then(function(response) {
                    console.log(response);

                    if(response.status != 200)
                    {
                        Swal.fire(
                            'Something went wrong!',
                            'Your file is NOT deleted.',
                            'error'
                        );
                        return;
                    }

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your post has been deleted.',
                        'success'
                    );

                    postId.classList.add('d-none');
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary post is safe :)',
                'error'
                );
            }
            })





        }

    </script>
@endsection
