@extends('../layouts/master')
@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3 posts">
            <header>
                <h3>This is dasboard</h3>
                <h5>What do you have to say?</h5>
                <form action="{{route('post_create')}}" method="post">
                    <div class="form-group">
                        <textarea name="body" id="new-post" rows="5" cols="80"></textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
                @include('../includes/message-block')
            </header>
        </div>
    </section>
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3 posts">
            <header>
                @if($posts != null)
                <h5>What other people say...</h5>
                    @foreach($posts as $post)
                        <section class="post">
                            <p class="postid" style="visibility: hidden">{{$post->id}}</p>
                            <p class="body">{{$post->body}}</p>
                            <div class="info">
                                Posted by <span class="firstname">{{$post->user->firstname}}</span> on {{$post->created_at}}
                            </div>
                            <div class="interaction">
                                <a href="#" class="like">
                                    @if(Auth::user()->likes()->where(['post_id'=>$post->id])->first())
                                        You add like on post
                                        @else
                                        Like
                                    @endif</a>
                                @if(Auth::user() == $post->user)
                                    <a href="#" class="edit">Edit</a>
                                    <a href="{{route('post.delete',['post_id'=>$post->id])}}" >Delete</a>
                                @endif
                            </div>
                            <br />
                        </section>
                    @endforeach
                  @else
                        <p>'There are no posts.'</p>
                 @endif
            </header>
            {{ $posts->links() }}
        </div>
    </section>

    <div class="modal fade model1" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the post by <span id="fill-firstname"></span></label>
                            <textarea name="post-body" id="post-body" rows="10" class="form-control fill-body"></textarea>
                        </div>
                        <div class="row errorclass">
                            <div class="col-md-12">
                                <ul class="list-group-item-danger">
                                  <li>Required Text to body</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-body">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <script>
        var token1 = '{{Session::token()}}';
        var url1 = '{{route('edit')}}';
        var urllike = '{{route('like')}}';

    </script>
 @endsection

