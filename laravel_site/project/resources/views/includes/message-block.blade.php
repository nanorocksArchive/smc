@if(count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group-item-danger">
                @foreach($errors->all() as $e)
                    <li>{{$e}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(Session::has('message'))
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group-item-success">
              <li>  {{Session::get('message')}} </li>
            </ul>
        </div>
    </div>
@endif