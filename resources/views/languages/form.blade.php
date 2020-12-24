<p>Language Type:</p>
<div class="input-group">
<input type="text" name="language_name" value="{{ old('language') ?? $languages->language_name }}">
</div>
<div>{{$errors->first('language_name')}}</div>