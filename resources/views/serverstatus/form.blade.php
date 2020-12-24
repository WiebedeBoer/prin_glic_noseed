<p>Server status:</p>
<div class="input-group">
<input type="text" name="server_status" value="{{ old('server_status') ?? $serverstatus->server_status }}">
</div>
<div>{{$errors->first('server_status')}}</div>

<p>Server status opmerkingen:</p>
<div class="input-group">
<textarea id="server_status_remarks" name="server_status_remarks" rows="4" cols="50">
{{ old('server_status_remarks')  ?? $serverstatus->server_status_remarks }}
</textarea>
</div>
<div>{{$errors->first('server_status_remarks')}}</div>