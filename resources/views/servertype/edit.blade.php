@extends('layouts.appform')
@section('title')
Server type
@endsection
<!--name-->
@section('pagename')
Server Type
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server Type Wijziging</h2>
<form method="POST" action="/servertype/{{ $servertype->server_type_id }}" class="pb-3">
@method('PATCH')
@include('servertype.form')
<input type="submit" value="wijzig server type" class="btn btn-primary">
@csrf
</form>
@endsection