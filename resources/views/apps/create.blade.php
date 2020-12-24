@extends('layouts.appform')
@section('title')
Applicaties
@endsection
<!--name-->
@section('pagename')
Applicaties
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Registratie</h2>
<form method="POST" action="/apps" class="pb-3">
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--naam-->
<p>App naam:</p>
<div class="input-group">
<input type="text" name="app_name" value="{{ old('app_name') ?? $apps->app_name }}">
</div>
<div>{{$errors->first('app_name')}}</div>
<!--status-->
<p>App status:</p><div class="input-group">
<select name="app_status">
<optgroup label="status">
@foreach($appstatus as $status_app) 
    <option value="{{ $status_app->app_status_id }}" {{ $status_app->app_status_id ==$apps->app_status ? 'selected' : '' }}>{{ $status_app->app_status }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('app_status')}}</div>
<!--url-->
<p>App url:</p>
<div class="input-group">
<input type="text" name="app_url" value="{{ old('app_url') ?? $apps->app_url }}">
</div>
<div>{{$errors->first('app_url')}}</div>
</div>
</div>
</div>
<div>

<div class="dependencies">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Gewenste Afhankelijkheden</h2>
<!--notificatie-->
<label for="notify">Notificatie</label><br><input type="checkbox" name="notify" value="yes" checked>
<!--taal-->
<p>Taal en Versie:</p>
<div class="input-group">
<select name="language_dependency">
<optgroup label="taal afhankelijkheid">
@foreach($languagedependency as $language_dependency) 
    @if($language_dependency->language_id ==old('language_dependency'))
        <option value="{{ $language_dependency->language_id }}" selected>{{ $language_dependency->language_name }}</option>
    @else
    <option value="{{ $language_dependency->language_id }}">{{ $language_dependency->language_name }}</option>
    @endif
    
@endforeach
</select>
<input type="text" name="language_version" placeholder="7" value="{{ old('language_version') ?? $apps->language_version }}">
</div>
<div>{{$errors->first('language_dependency')}}</div>
<div>{{$errors->first('language_version')}}</div>
</div>
<!--framework-->
<p>Framework en Versie:</p>
<div class="input-group">
<select name="framework_dependency">
<optgroup label="framework afhankelijkheid">
@foreach($frameworkdependency as $framework_dependency) 
    @if($framework_dependency->framework_id ==old('framework_dependency'))
        <option value="{{ $framework_dependency->framework_id }}" selected>{{ $framework_dependency->framework_name }}</option>
    @else
        <option value="{{ $framework_dependency->framework_id }}">{{ $framework_dependency->framework_name }}</option>
    @endif
@endforeach
</select>
<input type="text" name="framework_version" placeholder="6" value="{{ old('framework_version') ?? $apps->framework_version }}">
</div>
<div>{{$errors->first('framework_dependency')}}</div>
<div>{{$errors->first('framework_version')}}</div>
</div>
<!--database-->
<p>Database:</p>
<div class="input-group">
<select name="database_dependency">
<optgroup label="database afhankelijkheid">
@foreach($databasedependency as $database_dependency) 
    @if($database_dependency->db_id ==old('database_dependency'))
        <option value="{{ $database_dependency->db_id }}" selected>{{ $database_dependency->db_name }}</option>
    @else
        <option value="{{ $database_dependency->db_id }}">{{ $database_dependency->db_name }}</option>
    @endif
@endforeach
</select>
</div>
<div>{{$errors->first('database_dependency')}}</div>
</div>
</div>
</div>
</div>

<!--servers-->
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Servers</h2>

<div style="min-height:100px;">
<select class="multipleSelect" name="servers[]" multiple class="form-control" style="min-height:100px;">
    @foreach($servers as $server)
    <option value="{{ $server[ 'server_id'] }}">{{ $server[ 'server_name'] }}</option>
    @endforeach
</select>                                                            
<script>
    $('.multipleSelect').fastselect();
</script>
</div>

</div>
</div>
</div>
</div>
</div>

<!--owners-->
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Eigenaren</h2>

<div style="min-height:100px;">
<select class="multipleSelect" name="appowners[]" multiple class="form-control" style="min-height:100px;">
    @foreach( $persons as $person)
        <option value="{{ $person[ 'person_id'] }}">{{ $person[ 'person_name'] }}</option>
    @endforeach
</select>
                                                            
<script>
    $('.multipleSelect').fastselect();
</script>
</div>

</div>
</div>
</div>
</div>
</div>

<!--functionaladmin-->
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Functioneel Beheerders</h2>

<div style="min-height:100px;">
<select class="multipleSelect" name="appfunctionaladmins[]" multiple class="form-control" style="min-height:100px;">
    @foreach( $persons as $person)
        <option value="{{ $person[ 'person_id'] }}">{{ $person[ 'person_name'] }}</option>
    @endforeach
</select>
                                                            
<script>
    $('.multipleSelect').fastselect();
</script>
</div>

</div>
</div>
</div>
</div>
</div>

<!--technicaladmin-->
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Technisch Beheerders</h2>

<div style="min-height:100px;">
<select class="multipleSelect" name="apptechadmins[]" multiple class="form-control" style="min-height:100px;">
    @foreach( $persons as $person)
        <option value="{{ $person[ 'person_id'] }}">{{ $person[ 'person_name'] }}</option>
    @endforeach
</select>
                                                            
<script>
    $('.multipleSelect').fastselect();
</script>
</div>

</div>
</div>
</div>
</div>
</div>

<!--suppliers-->
<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Leveranciers</h2>

<div style="min-height:100px;">
<select class="multipleSelect" name="appsuppliers[]" multiple class="form-control" style="min-height:100px;">
    @foreach( $persons as $person)
        <option value="{{ $person[ 'person_id'] }}">{{ $person[ 'person_name'] }}</option>
    @endforeach
</select>
                                                            
<script>
    $('.multipleSelect').fastselect();
</script>
</div>

</div>
</div>
</div>
</div>
</div>

<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Privacy</h2>
<!--privacy-->
<p>Privacy status:</p>
<div class="input-group">
<input type="text" name="privacy_status" value="{{ old('privacy_status') ?? $apps->privacy_status }}">
</div>
</div>
</div>
</div>
</div>

<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Contracten</h2>
<!--contracten-->
<p>DVO Link:</p>
<div class="input-group">
<input type="text" name="dvo_link" value="{{ old('dvo_link') ?? $apps->dvo_link }}">
</div>
<p>DVO:</p>
<div class="input-group">
<textarea id="dvo" name="dvo" rows="4" cols="50">{{ old('dvo')  ?? $apps->dvo }}</textarea>
</div>
<div>{{$errors->first('dvo')}}</div>

<p>SLA Link:</p>
<div class="input-group">
<input type="text" name="sla_link" value="{{ old('sla_link') ?? $apps->sla_link }}">
</div>
<p>SLA:</p>
<div class="input-group">
<textarea id="sla" name="sla" rows="4" cols="50">{{ old('sla')  ?? $apps->sla }}</textarea>
</div>
<div>{{$errors->first('sla')}}</div>
</div>
</div>
</div>
</div>

<div class="remarks">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Opmerkingen</h2>
<!--opmerkingen-->
<p>App opmerkingen:</p>
<div class="input-group">
<textarea id="app_remarks" name="app_remarks" rows="4" cols="50">{{ old('app_remarks')  ?? $apps->app_remarks }}</textarea>
</div>
<div>{{$errors->first('app_remarks')}}</div>
</div>
</div>
</div>
</div>
<input type="submit" value="registreer app" class="btn btn-primary">
@csrf
</form>
@endsection