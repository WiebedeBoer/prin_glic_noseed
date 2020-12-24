@extends('layouts.appmain')
@section('title')
Applicaties Leveranciers
@endsection
<!--name-->
@section('pagename')
Applicaties Leveranciers
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Leverancier Aanmaak</h2>
<p><a href="/suppliers/create" class="btn btn-primary">Voeg app leverancier toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Leveranciers</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/persons">App Leverancier Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($appsupplier as $app_supplier) 
        <tr class="clickable-row">  
        <!--leverancier--> 
        <td class="data-tabel"><a href="/suppliers/{{ $app_supplier->id }}">{{ $app_supplier->persons->person_name }}</a></td> 
        <!--app-->
        <td class="data-tabel"><a href="/apps/{{ $app_supplier->app_id }}">{{ $app_supplier->apps->app_name }}</a></td> 
        <!--wijzig-->
        <td class="data-tabel"><a href="/suppliers/{{ $app_supplier->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/suppliers/{{ $app_supplier->id }}" method="post">
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
        <th class="rug-text-nowrap sortable"><a href="/persons">App Leverancier Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $appsupplier->links() }}
@endsection