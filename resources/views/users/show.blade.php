@extends('layouts.appshow')
@section('title')
Gebruiker Details voor {{ $registered_user->name }}
@endsection
<!--name-->
@section('pagename')
Gebruiker Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('users.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<p><a href="/users/{{ $registered_user->id }}/edit" class="btn btn-primary">Wijzig profiel foto {{ $registered_user->name}}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Gebruiker Details</h2>
<ul class="nav navbar-nav">        
    <li class="nav-item">{{ $registered_user->name }}</li> 
    <li class="nav-item">{{ $registered_user->email }}</li>          
</ul>
@if($registered_user->image)
    <div>
    <img src="{{ asset('storage/'.$registered_user->image) }}" alt="profielfoto" class="img-thumbnail">
    </div>
@endif

@endsection