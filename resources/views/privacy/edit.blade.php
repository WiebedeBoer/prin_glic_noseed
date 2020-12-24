@extends('layouts.appform')
@section('title')
Privacy
@endsection
<!--name-->
@section('pagename')
Privacy
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('privacy.submenu')
@endsection
<!--content-->
@section('content')
        <h2>Privacy Wijziging voor <a href="/apps/{{ $privacy->privacy_id }}">{{ $apps->app_name }}</a></h2>
<form method="POST" action="/privacy/{{ $privacy->privacy_id }}" class="pb-3">
@method('PATCH')
@include('privacy.form')
<input type="submit" value="wijzig Privacy" class="btn btn-primary">
@csrf
</form>
@endsection