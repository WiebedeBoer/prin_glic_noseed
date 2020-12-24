@extends('layouts.appform')
@section('title')
Servers en Apps
@endsection
<!--name-->
@section('pagename')
Severs &amp; Apps
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('serverapps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server en App Registratie</h2>
<form method="POST" action="/serverapps" class="pb-3">

<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--server-->
<p>Server:</p>
<div class="input-group">
<select name="server">
<optgroup label="server">
@foreach($servers as $server) 
    @if(old('server') == $server->server_id)
        <option value="{{ $server->server_id }}" selected>{{ $server->server_name }}</option>
    @else
        <option value="{{ $server->server_id }}">{{ $server->server_name }}</option>
    @endif   
@endforeach
</select>
</div>
<div>{{$errors->first('server')}}</div>
<!--app-->
<p>App:</p>
<div class="input-group">
<select name="app">
<optgroup label="app">
@foreach($apps as $app) 
    @if(old('app') == $app->app_id )
        <option value="{{ $app->app_id }}" selected>{{ $app->app_name }}</option>
    @else
        <option value="{{ $app->app_id }}">{{ $app->app_name }}</option>
    @endif
@endforeach
</select>
</div>
<div>{{$errors->first('app')}}</div>
</div>
</div>
</div>
</div>

<input type="submit" value="registreer server en app" class="btn btn-primary">
@csrf
</form>
@endsection