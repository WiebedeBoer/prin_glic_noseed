<div class="algemeen">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Algemeen</h2>
<!--library-->
<p>Dependency binnen Framework naam:</p>
<div class="input-group">
<input type="text" name="dependency_name" value="{{ old('dependency_name') ?? $libraries->dependency_name }}">
</div>
<div>{{$errors->first('dependency_name')}}</div>
<!--app-->
<p>Library:</p>
<div class="input-group">
<select name="library_id">
<optgroup label="app library">
@foreach($apps_library as $app_library) 
    <option value="{{ $app_library->library_id }}" {{ $app_library->library_id ==$libraries->library_id ? 'selected' : '' }}>{{ $app_library->dependency_name }}</option>
@endforeach
</select>
</div>
<div>{{$errors->first('library_id')}}</div>
<!--library-->
<p>Dependency binnen Framework naam:</p>
<div class="input-group">
<textarea id="dependency_description" name="dependency_description" rows="4" cols="50">
{{ old('dependency_description')  ?? $libraries->dependency_description }}
</textarea>
</div>
<div>{{$errors->first('dependency_description')}}</div>
</div>
</div>
</div>
</div>