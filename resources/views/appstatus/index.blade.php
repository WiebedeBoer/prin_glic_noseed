@extends('layouts.appmain')
@section('title')
Applicaties Status
@endsection
<!--name-->
@section('pagename')
Applicaties Status
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Status Aanmaak</h2>
<p><a href="/appstatus/create" class="btn btn-primary">Voeg app status toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Apps Status</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">App Status Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($appstatus as $web_app) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/appstatus/{{ $web_app->app_status_id }}">{{ $web_app->app_status }}</a></td> 
        <td class="data-tabel"><a href="/appstatus/{{ $web_app->app_status_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/appstatus/{{ $web_app->app_status_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">App Status Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $appstatus->links() }}
@endsection