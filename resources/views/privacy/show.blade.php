@extends('layouts.appextra')
@section('title')
Privacy Details voor {{ $apps->app_name }}
@endsection
<!--name-->
@section('pagename')
Privacy Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('privacy.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Wijzig</h2>
<p><a href="/privacy/{{ $privacy->privacy_id }}/edit" class="btn btn-primary">Wijzig {{ $apps->app_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Privacy Details voor <a href="/apps/{{ $privacy->privacy_id }}">{{ $apps->app_name }}</a></h2>

<div><h4>Doeleinden</h4>
{{ $privacy->goals }}
</div>

<div><h4>Betrokkenen</h4>
{{ $privacy->involved }}
</div>

<div><h4>Persoonsgegevens</h4>
{{ $privacy->person_data }}
</div>

<div><h4>Bewaartermijn</h4>
{{ $privacy->terms }}
</div>

<div><h4>Ontvangers</h4>
{{ $privacy->recipients }}
</div>

<div><h4>Buiten EU</h4>
{{ $privacy->extern }}
</div>

<div><h4>Beveiligingsmaatregelen</h4>
{{ $privacy->safety_measures }}
</div>

<div><h4>Opdrachtgever</h4>
{{ $privacy->clients }}
</div>

@endsection
@section('addition')
<!--app leverancier-->

<h2>App leveranciers:</h2>
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Wijzig App Leverancier</th>
          <th class="rug-text-nowrap sortable">Wijzig Persoon</th>
        </tr>
    </thead>
    <tbody>
@if($appsupplier !=false)
  @foreach($appsupplier as $app_supplier) 
    <tr class="clickable-row">
    <td class="data-tabel"><a href="/apptechadmin/{{ $app_supplier->id }}/edit">{{ $app_supplier->persons->person_name }}</a></td>
    <td class="data-tabel"><a href="/persons/{{ $app_supplier->app_supplier_id }}/edit">{{ $app_supplier->persons->person_email }}</a></td>
    </tr>
  @endforeach
@endif
</tbody>
</table>

@endsection