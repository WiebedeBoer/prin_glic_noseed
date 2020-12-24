<p>Framework Type:</p>
<div class="input-group">
<input type="text" name="framework_name" value="{{ old('framework') ?? $frameworks->framework_name }}">
</div>
<div>{{$errors->first('framework_name')}}</div>