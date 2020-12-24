<p>App eigenaar:</p>


<div class="input-group">
<select name="app_owner_id">
<optgroup label="app eigenaar">
@foreach($persons as $contact_person) 
    @if($new_person==$contact_person->person_id)
        <option value="{{ $contact_person->person_id }}" selected>{{ $contact_person->person_name }}</option>
    @else
        <option value="{{ $contact_person->person_id }}" {{ $contact_person->person_id ==$appowner->app_owner_id ? 'selected' : '' }}>{{ $contact_person->person_name }}</option>
    @endif 
@endforeach
</select>
</div>
<div>{{$errors->first('app_owner_id')}}</div>

<p>App:</p>

<div class="input-group">
<select name="app_id">
<optgroup label="app">
@foreach($apps as $app) 
    @if ($new_app==$app->app_id)
        <option value="{{ $app->app_id }}" selected>{{ $app->app_name }}</option>
    @else
        <option value="{{ $app->app_id }}" {{ $app->app_id ==$appowner->app_id ? 'selected' : '' }}>{{ $app->app_name }}</option>
    @endif
@endforeach
</select>
</div>
<div>{{$errors->first('app_id')}}</div>

<p>Uren:</p>
<div class="input-group">
<input type="text" name="hours" value="{{ old('hours') ?? $appowner->hours }}">
</div>