<!--server en app-->
<p>App en Server:</p><div class="input-group">
<select name="server_app_id">
<optgroup label="App en Server">
@foreach($appserver as $server_app) 
    <option value="{{ $server_app->id }}" {{ $server_app->server_app_id ==$server_app->id ? 'selected' : '' }}>{{ $server_app->apps->app_name }} - {{ $server_app->servers->server_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_app_id')}}</div>

<p>Schatting:</p><div class="input-group">
<select name="estimate_id">
<optgroup label="Schatting">
@foreach($estimates as $estimate) 
    <option value="{{ $estimate->estimate_id }}" {{ $estimate->estimate_id ==$roadmap->estimate_id ? 'selected' : '' }}>{{ $estimate->hour_update }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('estimate_id')}}</div>

<!--status-->
<p>Status:</p><div class="input-group">
<select name="status">
<optgroup label="status">
    <option value="1" {{ $roadmap->status ==1 ? 'selected' : '' }}>aan</option>
    <option value="0" {{ $roadmap->status ==0 ? 'selected' : '' }}>uit</option>
</select>
</div>
<div>{{$errors->first('status')}}</div>

<p>Milestone datum:</p>
<div class="input-group">
<input type="text" name="milestone_date" placeholder="yyyy-mm-dd" value="{{ old('milestone_date') ?? $roadmap->milestone_date }}">
</div>
<div>{{$errors->first('milestone_date')}}</div>

<p>Release datum:</p>
<div class="input-group">
<input type="text" name="roadmap_release_date" placeholder="yyyy-mm-dd" value="{{ old('roadmap_release_date') ?? $roadmap->roadmap_release_date }}">
</div>
<div>{{$errors->first('roadmap_release_date')}}</div>

<!--update-->
<p>Update:</p>
<div class="input-group">
<input type="text" name="roadmap_update" placeholder="update" value="{{ old('roadmap_update') ?? $roadmap->roadmap_update }}">
</div>
<div>{{$errors->first('roadmap_update')}}</div>

<p>Release:</p>
<div class="input-group">
<input type="text" name="roadmap_release" placeholder="release" value="{{ old('roadmap_release') ?? $roadmap->roadmap_release }}">
</div>
<div>{{$errors->first('roadmap_release')}}</div>

<p>Wensen:</p>
<div class="input-group">
<input type="text" name="wishes" placeholder="wensen" value="{{ old('wishes') ?? $roadmap->wishes }}">
</div>
<div>{{$errors->first('wishes')}}</div>

<!--url-->
<p>Trello Bord:</p>
<div class="input-group">
<input type="text" name="trello_board" placeholder="https://trello.com/b/projetRnd/sprint-1" value="{{ old('trello_board') ?? $roadmap->trello_board }}">
</div>
<div>{{$errors->first('trello_board')}}</div>