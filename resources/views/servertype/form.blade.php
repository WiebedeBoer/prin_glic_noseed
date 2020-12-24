<p>Server type:</p>
<div class="input-group">
<input type="text" name="server_type" value="{{ old('server_type') ?? $servertype->server_type }}">
</div>
<div>{{$errors->first('server_type')}}</div>