<p>Roadmap update:</p>
<div class="input-group">
<input type="text" name="roadmap_update" value="{{ old('roadmap_update') ?? $roadmaptypes->roadmap_update }}">
</div>
<div>{{$errors->first('roadmap_update')}}</div>

<p>Start datum:</p>
<div class="input-group">
<input type="text" name="start_date" placeholder="yyyy-mm-dd" value="{{ old('start_date') ?? $roadmaptypes->start_date }}">
</div>
<div>{{$errors->first('start_date')}}</div>

<p>Einde datum:</p>
<div class="input-group">
<input type="text" name="end_date" placeholder="yyyy-mm-dd" value="{{ old('end_date') ?? $roadmaptypes->end_date }}">
</div>
<div>{{$errors->first('end_date')}}</div>

<p>Roadmap:</p>
<div class="input-group">
<select name="roadmap_id">
<optgroup label="roadmap">
@foreach($roadmaps as $roadmap) 
    <option value="{{ $roadmap->roadmap_id }}" {{ $roadmap->roadmap_id ==$roadmaptypes->roadmap_id ? 'selected' : '' }}>{{ $roadmap->roadmap_update }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('roadmap_id')}}</div>
<div>

<p>Roadmap taak:</p>
<div class="input-group">
<select name="roadmap_task">
<optgroup label="roadmap taak">
@foreach($roadmap_tasks as $roadmaptask) 
    <option value="{{ $roadmaptask->task_id }}" {{ $roadmaptask->task_id ==$roadmaptypes->roadmap_task ? 'selected' : '' }}>{{ $roadmaptask->roadmap_task }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('roadmap_task')}}</div>
<div>

<p>Server en App:</p>
<div class="input-group">
<select name="serverapp_id">
<optgroup label="server app">
@foreach($server_apps as $server_app) 
    <option value="{{ $server_app->id }}" {{ $server_app->id ==$roadmaptypes->serverapp_id ? 'selected' : '' }}>{{ $server_app->servers->server_name }} - {{$server_app->apps->app_name}}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('serverapp_id')}}</div>
<div>