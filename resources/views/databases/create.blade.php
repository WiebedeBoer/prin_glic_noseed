@extends('layouts.appform')
@section('title')
Database Types Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Database Type Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Database Type Afhankelijkheid Aanmaak</h2>
<form method="POST" action="/databases" class="pb-3">
@include('databases.form')
<input type="submit" value="Database Types Afhankelijkheid aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection