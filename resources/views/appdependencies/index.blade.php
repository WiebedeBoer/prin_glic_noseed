@extends('layouts.appmain')
@section('title')
Applicatie Dependencies
@endsection
<!--name-->
@section('pagename')
Applicatie Dependencies
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('appdependencies.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Dependency Aanmaak</h2>
<p><a href="/appdependencies/create" class="btn btn-primary">Voeg app toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Apps en App Dependencies</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">App Details</th>
          <th class="rug-text-nowrap sortable">Afhankelijke App</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($apps as $web_app) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/appdependencies/{{ $web_app->id }}">{{ $web_app->apps->app_name }}</a></td> 
        <!--afhankelijk-->
        <td class="data-tabel">{{ $web_app->dependent_apps->app_name }}</td>
        <!--wijzig-->
        <td class="data-tabel"><a href="/appdependencies/{{ $web_app->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <!--verwijder-->
        <td class="data-tabel">
        <form action="/appdependencies/{{ $web_app->id }}" method="post">
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
            <th class="rug-text-nowrap sortable">App Details</th>
            <th class="rug-text-nowrap sortable">Afhankelijke App</th>
            <th class="rug-text-nowrap sortable">Wijzig</th>
            <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $apps->links() }}
@endsection