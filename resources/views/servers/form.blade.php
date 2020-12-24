<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
</div>
</div>
</div>
<!--naam-->
<p>Server naam:</p><div class="input-group"><input type="text" name="server_name" value="{{old('server_name') ?? $server->server_name}}"></div>
<div>{{$errors->first('server_name')}}</div>
<!--type-->
<p>Server type:</p>
<div class="input-group">
<select name="server_type">
<optgroup label="server type">
@foreach($servertype as $server_type) 
    <option value="{{ $server_type->server_type_id }}" {{ $server_type->server_type_id ==$server->server_type ? 'selected' : '' }}>{{ $server_type->server_type }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_type')}}</div>
<!--otap-->
<p>Server OTAP:</p>
<div class="input-group">
<select name="server_otap">
<optgroup label="server otap">
@foreach($serverotap as $server_otap) 
    <option value="{{ $server_otap->server_otap_id }}" {{ $server_otap->server_otap_id ==$server->server_otap ? 'selected' : '' }}>{{ $server_otap->server_otap }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_otap')}}</div>
<!--service-->
<p>Server Service:</p>
<div class="input-group">
<select name="server_service">
<optgroup label="server service">
@foreach($serverservice as $server_service) 
    <option value="{{ $server_service->server_service_id }}" {{ $server_otap->server_service_id ==$server->server_service ? 'selected' : '' }}>{{ $server_service->server_service }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_service')}}</div>
<!--notificatie-->
<label for="statusnotify">Status Notificatie</label><br><input type="checkbox" name="statusnotify" value="yes" checked>
<!--status-->
<p>Server Status:</p>
<div class="input-group">
<select name="server_status">
<optgroup label="server status">
@foreach($serverstatus as $server_status) 
    <option value="{{ $server_status->server_status_id }}" {{ $server_status->server_status_id ==$server->server_status ? 'selected' : '' }}>{{ $server_status->server_status }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_status')}}</div>
<!--notificatie-->
<label for="osnotify">OS Notificatie</label><br><input type="checkbox" name="osnotify" value="yes" checked>
<!--os-->
<p>Server Operating System:</p>
<div class="input-group">
<select name="server_operating_system">
<optgroup label="server operating system">
@foreach($serveros as $server_os) 
    <option value="{{ $server_os->server_os_id }}" {{ $server_os->server_os_id ==$server->server_operating_system ? 'selected' : '' }}>{{ $server_os->server_os_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('server_operating_system')}}</div>
</div>
<div class="costs">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Kosten</h2>
</div>
</div>
</div>
<!--kosten-->
<p>Server Kosten:</p>
<div class="input-group">
<input type="text" name="server_costs" placeholder="0" value="{{ old('server_costs') ?? $server->server_costs }}">
</div>
<div>{{$errors->first('server_costs')}}</div>
<!--geheugen kosten-->
<p>Geheugen Kosten:</p>
<div class="input-group">
<input type="text" name="memory_costs" placeholder="0" value="{{ old('memory_costs') ?? $server->memory_costs }}">
</div>
<div>{{$errors->first('memory_costs')}}</div>
<!--sla kosten-->
<p>SLA Kosten:</p>
<div class="input-group">
<input type="text" name="sla_costs" placeholder="0" value="{{ old('sla_costs') ?? $server->sla_costs }}">
</div>
<div>{{$errors->first('sla_costs')}}</div>
</div>
<div class="calendar">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Kalender</h2>
</div>
</div>
</div>
<!--acquisitie-->
<p>Acquisitie datum:</p>
<div class="input-group">
<input type="text" name="server_acquisition" placeholder="yyyy-mm-dd" value="{{ old('server_acquisition') ?? $server->server_acquisition }}">
</div>
<div>{{$errors->first('server_acquisition')}}</div>
<!--terminatie-->
<p>Terminatie datum:</p>
<div class="input-group">
<input type="text" name="server_termination" placeholder="yyyy-mm-dd" value="{{ old('server_termination') ?? $server->server_termination }}">
</div>
<div>{{$errors->first('server_termination')}}</div>
<!--certificaat-->
<p>Certificaat datum:</p>
<div class="input-group">
<input type="text" name="server_certificate_expiration" placeholder="yyyy-mm-dd" value="{{ old('server_certificate_expiration') ?? $server->server_certificate_expiration }}">
</div>
<div>{{$errors->first('server_certificate_expiration')}}</div>
</div>
<div class="remarks">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Opmerkingen</h2>
</div>
</div>
</div>
<!--opmerkingen-->
<p>Server opmerkingen:</p>
<div class="input-group">
<textarea id="server_remarks" name="server_remarks" rows="4" cols="50">{{ old('server_remarks')  ?? $server->server_remarks }}</textarea>
</div>
<div>{{$errors->first('server_remarks')}}</div>
</div>