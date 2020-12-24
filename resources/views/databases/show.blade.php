@extends('layouts.appshow')
@section('title')
Database Types Afhankelijkheden Details voor {{ $databases->dn_name }}
@endsection
<!--name-->
@section('pagename')
Database Types Afhankelijkheden Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/databases/{{ $databases->db_id }}/edit" class="btn btn-primary">Wijzig {{ $databases->dn_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Database Types Afhankelijkheden Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $databases->db_name }}</li>
</ul>
@endsection