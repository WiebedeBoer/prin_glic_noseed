<p>Server OS naam:</p>
<div class="input-group">
<input type="text" name="server_os_name" value="{{ old('server_os_name') ?? $serveros->server_os_name }}">
</div>
<div>{{$errors->first('server_os_name')}}</div>

<p>Code naam:</p>
<div class="input-group">
<input type="text" name="code_name" value="{{ old('code_name') ?? $serveros->code_name }}">
</div>
<div>{{$errors->first('code_name')}}</div>

<p>Release datum:</p>
<div class="input-group">
<input type="text" name="release" placeholder="yyyy-mm-dd" value="{{ old('release') ?? $serveros->release }}">
</div>
<div>{{$errors->first('release')}}</div>

<p>Einde support datum:</p>
<div class="input-group">
<input type="text" name="end_of_support" placeholder="yyyy-mm-dd" value="{{ old('end_of_support') ?? $serveros->end_of_support }}">
</div>
<div>{{$errors->first('end_of_support')}}</div>

<p>Notificatie datum:</p>
<div class="input-group">
<input type="text" name="notification" placeholder="yyyy-mm-dd" value="{{ old('notification') ?? $serveros->notification }}">
</div>
<div>{{$errors->first('notification')}}</div>

<p>Server OS beschrijving:</p>
<div class="input-group">
<textarea id="server_os_description" name="server_os_description" rows="4" cols="50">
{{ old('server_os_description')  ?? $serveros->server_os_description }}
</textarea>
</div>
<div>{{$errors->first('server_os_description')}}</div>