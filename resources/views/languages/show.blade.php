@extends('layouts.appshow')
@section('title')
Language Types Afhankelijkheden Details voor {{ $languages->language_name }}
@endsection
<!--name-->
@section('pagename')
Language Types Afhankelijkheden Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/languages/{{ $languages->language_id }}/edit" class="btn btn-primary">Wijzig {{ $languages->language_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Language Types Afhankelijkheden Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $languages->language_name }}</li>
</ul>
@endsection