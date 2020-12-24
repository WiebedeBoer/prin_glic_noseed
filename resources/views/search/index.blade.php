@extends('layouts.appcontent')
@section('title')
Zoeken
@endsection
<!--name-->
@section('pagename')
Zoeken
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('search.submenu')
@endsection
<!--addcontent-->
@section('content')
<h2>Zoeken</h2>
<form method="POST" action="/search/show" class="pb-3">
@method('PATCH')
<h2>Algemeen</h2>
<!--term-->
<p>Term:</p>
<div class="input-group">
<input type="text" name="term" value="{{ old('term') }}">
</div>
<div>{{$errors->first('term')}}</div>
<!--type-->
<p>Type:</p>
<div class="input-group">
<select name="type">
<option value="1">Operating System</option>
<option value="2">Language</option>
<option value="3">Framework</option>
<option value="4">Database</option>
<option value="5">Library</option>
</select>
</div>
<div>{{$errors->first('type')}}</div>
<input type="submit" value="zoeken" class="btn btn-primary">
@csrf
</form>
@endsection