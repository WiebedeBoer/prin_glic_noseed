<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--server-->
<p>App:</p>
<div class="input-group">
<select name="app_id">
<optgroup label="app">
@foreach($apps as $app) 
    <option value="{{ $app->app_id }}" {{ $app->app_id ==$appdependency->app_id ? 'selected' : '' }}>{{ $app->app_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('app_id')}}</div>
<!--app-->
<p>Afhankelijke App:</p>
<div class="input-group">
<select name="dependent_app_id">
<optgroup label="afhankelijke app">
@foreach($apps as $app) 
    <option value="{{ $app->app_id }}" {{ $app->app_id ==$appdependency->dependent_app_id ? 'selected' : '' }}>{{ $app->app_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('dependent_app_id')}}</div>
<div>
</div>
</div>
</div>