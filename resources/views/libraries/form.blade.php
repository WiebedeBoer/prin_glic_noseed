<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--library-->
<p>Dependency:</p>
<div class="input-group">
<input type="text" name="dependency_name" value="{{ old('dependency_name') ?? $libraries->dependency_name }}">
</div>
<div>{{$errors->first('dependency_name')}}</div>
<!--app-->
<p>App:</p>
<div class="input-group">
<select name="app_id">
<optgroup label="app">
@foreach($apps as $app) 
    <option value="{{ $app->app_id }}" {{ $app->app_id ==$libraries->app_id ? 'selected' : '' }}>{{ $app->app_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('app_id')}}</div>
</div>
</div>
</div>
</div>