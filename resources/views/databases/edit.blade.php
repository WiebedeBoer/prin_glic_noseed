@extends('layouts.appform')
@section('title')
Database Type Afhankelijkheden
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
        <h2>Database Type Afhankelijkheid Wijziging</h2>
<form method="POST" action="/databases/{{ $databases->db_id }}" class="pb-3">
@method('PATCH')
@include('databases.form')
<input type="submit" value="wijzig Database Type Afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@endsection