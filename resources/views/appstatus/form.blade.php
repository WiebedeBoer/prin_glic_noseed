<p>App status:</p>
<div class="input-group">
<input type="text" name="app_status" value="{{ old('app_status') ?? $appstatus->app_status }}">
</div>
<div>{{$errors->first('app_status')}}</div>