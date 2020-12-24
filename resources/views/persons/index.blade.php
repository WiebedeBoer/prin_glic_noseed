@extends('layouts.appmain')
@section('title')
Personen
@endsection
<!--name-->
@section('pagename')
Personen
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('persons.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Persoon Registratie</h2>
<p><a href="/persons/create" class="btn btn-primary">Voeg persoon toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Personen</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th>Persoon Details
          <a href="/persons/?sort=person_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Eigenaar</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Technisch</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Functioneel</a></th>
          <th class="rug-text-nowrap sortable"><a href="/suppliers">Leverancier</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($persons as $registered_person)
        <tr class="clickable-row">    
        <td class="data-tabel">
        <a href="/persons/{{ $registered_person->person_id }}">{{ $registered_person->person_name }}</a>
        </td> 
        <td class="data-tabel">{{ $registered_person->appowners_count->count() }}</td>
        <td class="data-tabel">{{ $registered_person->apptechadmins_count->count() }}</td>
        <td class="data-tabel">{{ $registered_person->appfunctionaladmins_count->count() }}</td>
        <td class="data-tabel">{{ $registered_person->appsuppliers_count->count() }}</td>
        <td>
        <a href="/persons/{{ $registered_person->person_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        <td class="data-tabel">
        <form action="/persons/{{ $registered_person->person_id }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Verwijder</button>
        </form>
        </td> 
        </tr>  
    @endforeach
    </tbody>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Persoon Details
          <a href="/persons/?sort=person_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Eigenaar</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Technisch</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Functioneel</a></th>
          <th class="rug-text-nowrap sortable"><a href="/suppliers">Leverancier</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $persons->links() }}
@endsection