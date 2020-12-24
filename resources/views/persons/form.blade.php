<p>Persoonsnaam:</p>
<div class="input-group">
<input type="text" name="person_name" value="{{old('person_name') ?? $persons->person_name}}">
</div>
<div>{{$errors->first('person_name')}}</div>

<p>Persoon E-mailadres:</p>
<div class="input-group">
<input type="text" name="person_email" value="{{old('person_email') ?? $persons->person_email}}">
</div>
<div>{{$errors->first('person_email')}}</div>

<p>Staf nummer:</p>
<div class="input-group">
<input type="text" name="person_staff_number" placeholder="P100111" value="{{old('person_staff_number') ?? $persons->person_staff_number}}">
</div>
<div>{{$errors->first('person_staff_number')}}</div>