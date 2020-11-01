@extends('layouts.app')

@section('Dashboard', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5">
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 offset-0 offset-sm-0 offset-md-1 offset-lg-1">
            <div class="row">
                <div class="col-12 shadow p-4 rounded-lg">
                    <h3 class="font-weight-bolder">Write a Post</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <div class="form-group">
                                <textarea class="form-control form-control-lg" rows="8" id="validationTextarea"
                                    placeholder="What you have to say ?"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg pl-3 pr-3 font-weight-bolder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                    Create Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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

                        <div class="if-container">
                            @foreach ($posts as $post)
                                <div class="post border-primary mt-4" style="border-left: solid 5px; background: #ddd">
                                    <div class="card-body">
                                        @if ($post->user_id == Auth::user()->id)
                                            <p class="text-right mb-1" style="font-size: 1.4rem">
                                                <button class="btn btn-success p-1 rounded font-weight-bolder">Edit</button>
                                                <button
                                                    class="btn btn-danger p-1 rounded font-weight-bolder">Delete</button>
                                            </p>
                                        @endif
                                        <p>
                                            {{ $post->body }}
                                        </p>
                                        <div class="d-flex">
                                            <button class="btn btn-primary btn-sm pl-3 pr-3 font-weight-bolder" @if (Auth::user()
            ->likes()
            ->where(['post_id' => $post->id])
        ->first())data-like-status="1" @else data-like-status="0"
                            @endif data-post-id="{{ $post->id }}"
                            data-user-id="{{ Auth::user()->id }}"onclick="toggleLike(this, `{{ route('toggle.like') }}`)">
                            <span id="like-{{$post->id}}">
                            @if (Auth::user()
            ->likes()
            ->where(['post_id' => $post->id])
            ->first())
                                You add like on post
                            @else
                                Like
                            @endif
                            </span>
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-hand-thumbs-up"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16v-1c.563 0 .901-.272 1.066-.56a.865.865 0 0 0 .121-.416c0-.12-.035-.165-.04-.17l-.354-.354.353-.354c.202-.201.407-.511.505-.804.104-.312.043-.441-.005-.488l-.353-.354.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315L12.793 9l.353-.354c.353-.352.373-.713.267-1.02-.122-.35-.396-.593-.571-.652-.653-.217-1.447-.224-2.11-.164a8.907 8.907 0 0 0-1.094.171l-.014.003-.003.001a.5.5 0 0 1-.595-.643 8.34 8.34 0 0 0 .145-4.726c-.03-.111-.128-.215-.288-.255l-.262-.065c-.306-.077-.642.156-.667.518-.075 1.082-.239 2.15-.482 2.85-.174.502-.603 1.268-1.238 1.977-.637.712-1.519 1.41-2.614 1.708-.394.108-.62.396-.62.65v4.002c0 .26.22.515.553.55 1.293.137 1.936.53 2.491.868l.04.025c.27.164.495.296.776.393.277.095.63.163 1.14.163h3.5v1H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                            </svg>

                            <span id="likes-total-{{$post->id}}">{{ $post->likes->count() }}</span>

                            </button>
                            <p class="text-right small mb-0 mt-2 ml-auto font-italic text-muted">Posted by:
                                {{ $post->user->name }} on {{ date('d.M.Y', strtotime($post->created_at)) }}
                            </p>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>


        <div class="d-flex align-items-center pt-3 text-dark">
            <strong>Loading...</strong>
            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
        </div>

    </div>
    @endif
    </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        var token =  document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

                if(response.status != 200)
                {
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

    </script>
@endsection
