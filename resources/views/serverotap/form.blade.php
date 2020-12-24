<p>Server otap:</p>
<div class="input-group">
<input type="text" name="server_otap" value="{{ old('server_otap') ?? $serverotap->server_otap }}">
</div>
<div>{{$errors->first('server_otap')}}</div>