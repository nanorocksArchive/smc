@extends('layouts.app')

@section('Dashboard', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="row pt-5">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2">

            Dashboard
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
</script>
@endsection
