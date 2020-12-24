<!--goals-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Doeleinden</h4> 
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show">
    Waarom de verwerking gebeurt. De juridische grondslag wordt elders opgenomen.
    </div>
</div>
</div>
<div class="input-group">
<textarea id="goals" name="goals" rows="4" cols="50">
{{ old('goals')  ?? $privacy->goals }}
</textarea>
</div>
<div>{{$errors->first('goals')}}</div>
</div>
<!--involved-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Betrokkenen</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover2">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show2">
    Leners, medewerkers, studenten, klanten van elders (Hanze), externen (martinipashouders).
    </div>
</div>
</div>
<div class="input-group">
<textarea id="involved" name="involved" rows="4" cols="50">
{{ old('involved')  ?? $privacy->involved }}
</textarea>
</div>
<div>{{$errors->first('involved')}}</div>
</div>
<!--person data-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Persoonsgegevens</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover3">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show3">
    Welke gegevens van betrokkenen worden verwerkt? NAW, e-mail, IP-adres, beelden.
    </div>
</div>
</div>
<div class="input-group">
<textarea id="person_data" name="person_data" rows="4" cols="50">
{{ old('person_data')  ?? $privacy->person_data }}
</textarea>
</div>
<div>{{$errors->first('person_data')}}</div>
</div>
<!--bewaartermijn-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Opmerkingen</h4>
</div>
<div class="input-group">
<textarea id="terms" name="terms" rows="4" cols="50">
{{ old('terms')  ?? $privacy->terms }}
</textarea>
</div>
<div>{{$errors->first('terms')}}</div>
</div>
<!--recipients-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Ontvangers</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover4">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show4">
    Aan wie worden persoonsgegevens overgedragen (naam, adres).
    </div>
</div>
</div>
<div class="input-group">
<textarea id="recipients" name="recipients" rows="4" cols="50">
{{ old('recipients')  ?? $privacy->recipients }}
</textarea>
</div>
<div>{{$errors->first('recipients')}}</div>
</div>
<!--buiten-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Buiten EU</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover5">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show5">
    Worden data buiten EU verwerkt? Een kenmerk van de ontvanger.
    </div>
</div>
</div>
<div class="input-group">
<textarea id="extern" name="extern" rows="4" cols="50">
{{ old('extern')  ?? $privacy->extern }}
</textarea>
</div>
<div>{{$errors->first('extern')}}</div>
</div>
<!--beveiliging-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Beveiligingsmaatregelen</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover6">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show6">
    Technisch en organisatorisch (baseline, toegang).
    </div>
</div>
</div>
<div class="input-group">
<textarea id="safety_measures" name="safety_measures" rows="4" cols="50">
{{ old('safety_measures')  ?? $privacy->safety_measures }}
</textarea>
</div>
<div>{{$errors->first('safety_measures')}}</div>
</div>
<!--opdrachtgever-->
<div class="remarks py-3">
<div class="inline-block float-left ml-3">
<h4>Opdrachtgever</h4>
</div>
<div class="inline-block float-left ml-3">
<div id="to-hover7">
<img class="info" src="{{ asset('assets/images/info-black.png') }}" width="20" height="20">
    <div id="to-show7">
    Verwerk je persoonsgegevens van een andere organisatie (bv Hanze)? Zo ja, welke organisatie.
    </div>
</div>
</div>
<div class="input-group">
<textarea id="clients" name="clients" rows="4" cols="50">
{{ old('clients')  ?? $privacy->clients }}
</textarea>
</div>
<div>{{$errors->first('clients')}}</div>
</div>

