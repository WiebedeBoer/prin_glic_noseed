@extends('layouts.appmain')
@section('title')
Uren Personen
@endsection
<!--name-->
@section('pagename')
Personen
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Persoon Registratie</h2>
<p><a href="/persons/create" class="btn btn-primary">Voeg persoon toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Personen en Uren</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th>Persoon Details
          <a href="/hours/person/?sort=person_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Eigenaar</a> FTE</th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Technisch</a> FTE</th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Functioneel</a> FTE</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
        </tr>
    </thead>
    <tbody>
    @foreach($persons as $registered_person)
        <tr class="clickable-row">    
        <td class="data-tabel">
        <a href="/persons/{{ $registered_person->person_id }}">{{ $registered_person->person_name }}</a>
        </td> 
        <td class="data-tabel">{{ $registered_person->appownersumfte }}</td>
        <td class="data-tabel">{{ $registered_person->apptechadminsumfte }}</td>
        <td class="data-tabel">{{ $registered_person->appfunctionaladminsumfte }}</td>
        <td>
        <a href="/persons/{{ $registered_person->person_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        </tr>  
    @endforeach
    </tbody>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Persoon Details
          <a href="/persons/?sort=person_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Eigenaar</a> FTE</th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Technisch</a> FTE</th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Functioneel</a> FTE</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
        </tr>
    </thead>
</table>

<!--uren totalen-->
<div class="col-12 d-flex justify-content-center pt-5">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Totalen</h2>
<table class="table table-striped">
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">Uren Totaal Eigenaar</th>
          <th class="rug-text-nowrap sortable">Uren Totaal Technisch</th>
          <th class="rug-text-nowrap sortable">Uren Totaal Functioneel</th>
        </tr>
    </thead>
    <tbody>    
    <tr>
        <td class="data-tabel">{{ $totalappowner }}</td>
        <td class="data-tabel">{{ $totalapptechadmin }}</td>
        <td class="data-tabel">{{ $totalappfunctionaladmin }}</td>
    </tr>
    </tbody>
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">FTE Totaal Eigenaar</th>
          <th class="rug-text-nowrap sortable">FTE Totaal Technisch</th>
          <th class="rug-text-nowrap sortable">FTE Totaal Functioneel</th>
        </tr>
    </thead>
    <tbody>    
    <tr>
        <td class="data-tabel">{{ $totalappownerfte }}</td>
        <td class="data-tabel">{{ $totalapptechadminfte }}</td>
        <td class="data-tabel">{{ $totalappfunctionaladminfte }}</td>
    </tr>
    </tbody>
</table>   
</div>
</div>
</div>
</div>


@endsection
@section('listlinks')
    {{ $persons->links() }}
@endsection