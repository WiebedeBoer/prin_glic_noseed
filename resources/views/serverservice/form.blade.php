<p>Server service:</p>
<div class="input-group">
<input type="text" name="server_service" value="{{ old('server_service') ?? $serverservice->server_service }}">
</div>
<div>{{$errors->first('server_service')}}</div>

<p>Server service beschrijving:</p>
<div class="input-group">
<textarea id="server_service_description" name="server_service_description" rows="4" cols="50">
{{ old('server_service_description')  ?? $serverservice->server_service_description }}
</textarea>
</div>
<div>{{$errors->first('server_service_description')}}</div>