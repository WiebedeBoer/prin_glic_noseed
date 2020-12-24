<p>Database Type:</p>
<div class="input-group">
<input type="text" name="db_name" value="{{ old('database') ?? $databases->db_name }}">
</div>
<div>{{$errors->first('db_name')}}</div>