@extends('layouts.appform')
@section('title')
Applicaties Leverancier
@endsection
<!--name-->
@section('pagename')
Applicaties Leverancier
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Leverancier Wijziging</h2>
<form method="POST" action="/suppliers/{{ $appsupplier->id }}" class="pb-3">
@method('PATCH')
@include('suppliers.form')
<input type="submit" value="wijzig App Leverancier" class="btn btn-primary">
@csrf
</form>
@endsection