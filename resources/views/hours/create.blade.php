@extends('layouts.appform')
@section('title')
Urenschatting
@endsection
<!--name-->
@section('pagename')
Urenschatting
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--content-->
@section('content')
<h2>Urenschatting Aanmaak</h2>
<form method="POST" action="/hours" class="pb-3">
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>

<!--server en app-->
<p>App en Server:</p><div class="input-group">
<select name="server_app_id">
<optgroup label="App en Server">
@foreach($appserver as $server_app) 
<option value="{{ $server_app->id }}" {{ $estimate->server_app_id ==$server_app->id ? 'selected' : '' }}>{{ $server_app->apps->app_name }} {{ $server_app->servers->server_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_app_id')}}</div>

<!--urenschatting-->
<p>Urenschatting:</p>
<div class="input-group">
<input type="text" name="hour_estimate" placeholder="40" value="{{ old('hour_estimate') ?? $estimate->hour_estimate }}">
</div>
<div>{{$errors->first('hour_estimate')}}</div>

<!--update-->
<p>Update en Release:</p>
<div class="input-group">
<input type="text" name="hour_update" placeholder="release 1.1" value="{{ old('hour_update') ?? $estimate->hour_update }}">
</div>
<div>{{$errors->first('hour_update')}}</div>

<!--url-->
<p>Trello Bord:</p>
<div class="input-group">
<input type="text" name="trello_board" placeholder="https://trello.com/b/projetRnd/sprint-1" value="{{ old('trello_board') ?? $estimate->trello_board }}">
</div>
<div>{{$errors->first('trello_board')}}</div>

<!--status-->
<p>Status:</p><div class="input-group">
<select name="status">
<optgroup label="status">
    <option value="1" selected>huidig</option>
    <option value="0">archief</option>
</select>
</div>
<div>{{$errors->first('status')}}</div>

</div>
</div>
</div>
</div>
<input type="submit" value="maak urenschatting aan" class="btn btn-primary">
@csrf
</form>
@endsection