@extends('layouts.appextra')
@section('title')
Persoon Details voor {{ $persons->person_name }}
@endsection
<!--name-->
@section('pagename')
Persoon Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('persons.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Wijzig</h2>
<p><a href="/persons/{{ $persons->person_id }}/edit" class="btn btn-primary">Wijzig {{ $persons->person_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Persoon Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">Persoonsnaam: {{ $persons->person_name }}</li>
        <li class="nav-item">E-mail: {{ $persons->person_email }}</li>
        <li class="nav-item">Staf nummer: {{ $persons->person_staff_number }}</li>
</ul>
@endsection
@section('addition')
@include('persons.apps')
@endsection