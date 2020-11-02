<div class="col-12 shadow p-4 rounded-lg">
    <h3 class="font-weight-bolder">Write a Post</h3>
    <form method="POST" action="{{ route('post.create') }}">
        @csrf
        <div class="mb-3">
            <div class="form-group">
                <textarea class="form-control form-control-lg" rows="8" id="post-body"
                    placeholder="What you have to say ?" name="post" required minlength="20" maxlength="1000"></textarea>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="small text-danger">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg pl-3 pr-3 font-weight-bolder" type="submit">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
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
