@extends('layouts.appform')
@section('title')
Servers en Apps Details voor {{ $serverapp->servers->server_name }}
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
<h2>Server en App Wijziging</h2>
<form method="POST" action="/serverapps/{{ $serverapp->id }}" class="pb-3">
@method('PATCH')

<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--server-->
<p>Server:</p>
<div class="input-group">
<select name="server_id">
<optgroup label="server">
@foreach($servers as $server) 
    <option value="{{ $server->server_id }}" {{ $server->server_id ==$serverapp->server_id ? 'selected' : '' }}>{{ $server->server_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server')}}</div>
<!--app-->
<p>App:</p>
<div class="input-group">
<select name="app_id">
<optgroup label="app">
@foreach($apps as $app) 
    <option value="{{ $app->app_id }}" {{ $app->app_id ==$serverapp->app_id ? 'selected' : '' }}>{{ $app->app_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('app')}}</div>
<div>
</div>
</div>
</div>

<div class="dependencies">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Aangepaste / Huidige Afhankelijkheden</h2>
<!--notificatie-->
<label for="notify">Notificatie</label><br><input type="checkbox" name="notify" value="yes" checked>
<!--taal-->
<p>Taal en Versie:</p>
<div class="input-group">
<select name="language_dependency">
<optgroup label="taal afhankelijkheid">
@foreach($languagedependency as $language_dependency) 
    <option value="{{ $language_dependency->language_id }}" {{ $language_dependency->language_id ==$serverapp->language_dependency ? 'selected' : '' }}>{{ $language_dependency->language_name }}</option>
@endforeach
</select>
<input type="text" name="language_version" placeholder="7" value="{{ old('language_version') ?? $serverapp->language_version }}">
</div>
<div>{{$errors->first('language_dependency')}}</div>
<div>{{$errors->first('language_version')}}</div>
</div>
<!--framework-->
<p>Framework en Versie:</p>
<div class="input-group">
<select name="framework_dependency">
<optgroup label="framework afhankelijkheid">
@foreach($frameworkdependency as $framework_dependency) 
    <option value="{{ $framework_dependency->framework_id }}" {{ $framework_dependency->framework_id ==$serverapp->framework_dependency ? 'selected' : '' }}>{{ $framework_dependency->framework_name }}</option>
@endforeach
</select>
<input type="text" name="framework_version" placeholder="6" value="{{ old('framework_version') ?? $serverapp->framework_version }}">
</div>
<div>{{$errors->first('framework_dependency')}}</div>
<div>{{$errors->first('framework_version')}}</div>
</div>
<!--database-->
<p>Database:</p>
<div class="input-group">
<select name="database_dependency">
<optgroup label="database afhankelijkheid">
@foreach($databasedependency as $database_dependency) 
    <option value="{{ $database_dependency->db_id }}" {{ $database_dependency->db_id ==$serverapp->database_dependency ? 'selected' : '' }}>{{ $database_dependency->db_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('database_dependency')}}</div>
</div>
</div>
</div>
</div>

<input type="submit" value="wijzig server en app" class="btn btn-primary">
@csrf
</form>

@endsection