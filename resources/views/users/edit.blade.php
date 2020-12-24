@extends('layouts.appform')
@section('title')
Gebruikersprofiel
@endsection
<!--name-->
@section('pagename')
Gebruikersprofiel
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('users.submenu')
@endsection
<!--content-->
@section('content')
<h2>Gebruikersprofiel</h2>
<form method="POST" action="/users/{{$registered_user->id}}" enctype="multipart/form-data" class="pb-3">
@method('PATCH')
<p>Profiel foto:</p>
<div class="input-group">
<label for="image">Profiel Foto</label>
<input type="file" name="image">
</div>
<div>{{$errors->first('image')}}</div>
<input type="submit" value="upload foto" class="btn btn-primary">
@csrf
</form>
@endsection