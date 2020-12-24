@extends('layouts.appshow')
@section('title')
Framework Types Afhankelijkheden Details voor {{ $frameworks->framework_name}}
@endsection
<!--name-->
@section('pagename')
<h1 class="rug-mb-0 rug-clearfix">Framework Types Afhankelijkheden Details</h1>
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/frameworks/{{ $frameworks->framework_id }}/edit" class="btn btn-primary">Wijzig {{ $frameworks->framework_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Framework Types Afhankelijkheden Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $frameworks->framework_name }}</li>
</ul>
@endsection