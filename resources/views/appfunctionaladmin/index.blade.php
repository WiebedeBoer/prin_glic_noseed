@extends('layouts.appmain')
@section('title')
Applicaties Functioneel Beheerders
@endsection
<!--name-->
@section('pagename')
Applicaties Functioneel Beheerders
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Functioneel Beheerder Aanmaak</h2>
<p><a href="/appfunctionaladmin/create" class="btn btn-primary">Voeg app functioneel beheerder toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Functioneel Beheerders</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/persons">App Functioneel Beheerder Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($appfunctionaladmin as $app_functionaladmin) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/appfunctionaladmin/{{ $app_functionaladmin->id }}">{{ $app_functionaladmin->persons->person_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_functionaladmin->app_id }}">{{ $app_functionaladmin->apps->app_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_functionaladmin->app_id }}">{{ $app_functionaladmin->hours }}</a></td>
        <td class="data-tabel"><a href="/appfunctionaladmin/{{ $app_functionaladmin->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/appfunctionaladmin/{{ $app_functionaladmin->id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/persons">App Functioneel Beheerder Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $appfunctionaladmin->links() }}
@endsection