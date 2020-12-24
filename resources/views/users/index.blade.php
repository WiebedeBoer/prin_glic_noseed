@extends('layouts.appcontent')
@section('title')
Gebruikers
@endsection
<!--name-->
@section('pagename')
Gebruikers
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('users.submenu')
@endsection
<!--addcontent-->
@section('content')
<h2>Gebruikers</h2>
<ul class="nav navbar-nav">
    @foreach($registered_users as $registered_user)    
        <li class="nav-item"><a href="/users/{{ $registered_user->id }}">{{ $registered_user->name }}</a></li>  
    @endforeach
</ul>
@endsection
@section('listlinks')
    {{ $registered_users->links() }}
@endsection