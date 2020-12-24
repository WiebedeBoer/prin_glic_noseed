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
<h2>Server Type Aanmaak</h2>
<form method="POST" action="/servertype" class="pb-3">
@include('servertype.form')
<input type="submit" value="server type aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection