<!--nieuwe personen-->
<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Nieuwe apps toevoegen</h2>
<p><a href="/appowner/create/?person={{$persons->person_id}}" class="btn btn-primary">Voeg app eigenaar toe</a></p>
<p><a href="/apptechadmin/create/?person={{$persons->person_id}}" class="btn btn-primary">Voeg app technisch beheerder toe</a></p>
<p><a href="/appfunctionaladmin/create/?person={{$persons->person_id}}" class="btn btn-primary">Voeg app functioneel beheerder toe</a></p>
<p><a href="/suppliers/create/?person={{$persons->person_id}}" class="btn btn-primary">Voeg app leverancier toe</a></p>
</div>
</div>
</div>
</div>
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Toegevoegd aan apps</h2>
</div>
</div>
</div>
<!--app eigenaren-->
@if($appownercount >=1)
<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>App eigenaar van: {{Arr::get($apptechadmin, 'apptechadmin')}}</h2>
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Wijzig App eigenaar</th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Fte</th>
          <th class="rug-text-nowrap sortable">Wijzig Persoon</th>
        </tr>
    </thead>
    <tbody>
  @foreach($appowner as $app_owner) 
    <tr>
    <td class="data-tabel"><a href="/appowner/{{ $app_owner->id }}/edit">{{ $app_owner->persons->person_name }}</a></td>
    <td class="data-tabel">{{ $app_owner->hours }}</td>
    <td class="data-tabel">{{ $app_owner->fte }}</td>
    <td class="data-tabel"><a href="/apps/{{ $app_owner->app_id }}/edit">{{ $app_owner->apps->app_name }}</a></td>
    </tr>
  @endforeach
</tbody>
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">&nbsp;</th>
          <th class="rug-text-nowrap sortable">Totaal Uren</th>
          <th class="rug-text-nowrap sortable">Totaal Fte</th>
          <th class="rug-text-nowrap sortable">Totaal Apps</th>
        </tr>
    </thead>
    <tbody>
    <tr class="clickable-row">
    <td class="data-tabel">&nbsp;</td>
    <td class="data-tabel">{{ $appownersum }}</td>
    <td class="data-tabel">{{ $appownersumfte }}</td>
    <td class="data-tabel">{{ $appownercount }}</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
@endif
<!--app technisch beheerder-->
@if($apptechadmincount >=1)
<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>App technisch beheerder van:</h2>
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Wijzig App Technisch Beheerder</th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Fte</th>
          <th class="rug-text-nowrap sortable">Wijzig App</th>
        </tr>
    </thead>
    <tbody>
  @foreach($apptechadmin as $app_techadmin) 
    <tr>
    <td class="data-tabel"><a href="/apptechadmin/{{ $app_techadmin->id }}/edit">{{ $app_techadmin->persons->person_name }}</a></td>
    <td class="data-tabel">{{ $app_techadmin->hours }}</td>
    <td class="data-tabel">{{ $app_techadmin->fte }}</td>
    <td class="data-tabel"><a href="/apps/{{ $app_techadmin->app_id }}/edit">{{ $app_techadmin->apps->app_name }}</a></td>
    </tr>
  @endforeach
</tbody>
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">&nbsp;</th>
          <th class="rug-text-nowrap sortable">Totaal Uren</th>
          <th class="rug-text-nowrap sortable">Totaal Fte</th>
          <th class="rug-text-nowrap sortable">Totaal Apps</th>
        </tr>
    </thead>
    <tbody>
    <tr class="clickable-row">
    <td class="data-tabel">&nbsp;</td>
    <td class="data-tabel">{{ $apptechadminsum }}</td>
    <td class="data-tabel">{{ $apptechadminsumfte }}</td>
    <td class="data-tabel">{{ $apptechadmincount }}</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
@endif
<!--app functioneel beheerder-->
@if($appfunctionaladmincount >=1)
<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>App functioneel beheerder van:</h2>
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Wijzig App Functioneel Beheerder</th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Fte</th>
          <th class="rug-text-nowrap sortable">Wijzig App</th>
        </tr>
    </thead>
    <tbody>
  @foreach($appfunctionaladmin as $app_functionaladmin) 
    <tr>
    <td class="data-tabel"><a href="/appfunctionaladmin/{{ $app_functionaladmin->id }}/edit">{{ $app_functionaladmin->persons->person_name }}</a></td>
    <td class="data-tabel">{{ $app_functionaladmin->hours }}</td>
    <td class="data-tabel">{{ $app_functionaladmin->fte }}</td>
    <td class="data-tabel"><a href="/apps/{{ $app_functionaladmin->app_id }}/edit">{{ $app_functionaladmin->apps->app_name }}</a></td>
    </tr>
  @endforeach
</tbody>
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">&nbsp;</th>
          <th class="rug-text-nowrap sortable">Totaal Uren</th>
          <th class="rug-text-nowrap sortable">Totaal Fte</th>
          <th class="rug-text-nowrap sortable">Totaal Apps</th>
        </tr>
    </thead>
    <tbody>
    <tr class="clickable-row">
    <td class="data-tabel">&nbsp;</td>
    <td class="data-tabel">{{ $appfunctionaladminsum }}</td>
    <td class="data-tabel">{{ $appfunctionaladminsumfte }}</td>
    <td class="data-tabel">{{ $appfunctionaladmincount }}</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
@endif
<!--app leverancier-->
@if($appsuppliercount >=1)
<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>App leveranciers:</h2>
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Wijzig App Leverancier</th>
          <th class="rug-text-nowrap sortable">Wijzig App</th>
        </tr>
    </thead>
    <tbody>
  @foreach($appsupplier as $app_supplier) 
    <tr class="clickable-row">
    <td class="data-tabel"><a href="/suppliers/{{ $app_supplier->id }}/edit">{{ $app_supplier->persons->person_name }}</a></td>
    <td class="data-tabel"><a href="/apps/{{ $app_supplier->app_id }}/edit">{{ $app_supplier->apps->app_name }}</a></td>
    </tr>
  @endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@endif
</div>