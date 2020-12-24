@extends('layouts.appmain')
@section('title')
Applicaties
@endsection
<!--name-->
@section('pagename')
Applicaties
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Registratie</h2>
<p><a href="/apps/create" class="btn btn-primary">Voeg app toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Apps</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/apps">App Details</a> 
          <a href="/apps/?sort=app_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appstatus">App Status</a>
          <a href="/apps/?sort=app_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/languages">Taal en Versie</a>
          <a href="/apps/?sort=language_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/frameworks">Framework en Versie</a>
          <a href="/apps/?sort=framework_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database</a>
          <a href="/apps/?sort=database_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Servers</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Aantal Eigenaars</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Aantal Technisch Beheerders</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Aantal Functioneel Beheerders</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($apps as $web_app) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/apps/{{ $web_app->app_id }}">{{ $web_app->app_name }}</a></td> 
        <!--status-->
        <td class="data-tabel">{{ $web_app->apps_status->app_status }}</td>
        <!--taal en versie-->
        <td class="data-tabel">{{ $web_app->apps_language->language_name }} {{ $web_app->language_version }}</td>
        <!--framework en versie-->
        <td class="data-tabel">{{ $web_app->apps_framework->framework_name }} {{ $web_app->framework_version }}</td>
        <!--database-->
        <td class="data-tabel">{{ $web_app->apps_database->db_name }}</td>
        <!--server count-->
        <td class="data-tabel">{{ $web_app->serverapps_count->count() }}</td>
        <!--app owner-->
        @if($web_app->appowners_count->count() >=2)
        <td class="data-tabel" style="color:green;">{{ $web_app->appowners_count->count() }}</td>
        @elseif($web_app->appowners_count->count() ==1)
        <td class="data-tabel" style="color:orange;">{{ $web_app->appowners_count->count() }}</td>
        @else
        <td class="data-tabel" style="color:red;">{{ $web_app->appowners_count->count() }}</td>
        @endif
        <!--app owner-->
        @if($web_app->apptechadmins_count->count() >=2)
        <td class="data-tabel" style="color:green;">{{ $web_app->apptechadmins_count->count() }}</td>
        @elseif($web_app->apptechadmins_count->count() ==1)
        <td class="data-tabel" style="color:orange;">{{ $web_app->apptechadmins_count->count() }}</td>
        @else
        <td class="data-tabel" style="color:red;">{{ $web_app->apptechadmins_count->count() }}</td>
        @endif
        <!--app owner-->
        @if($web_app->appfunctionaladmins_count->count() >=2)
        <td class="data-tabel" style="color:green;">{{ $web_app->appfunctionaladmins_count->count() }}</td>
        @elseif($web_app->appfunctionaladmins_count->count() ==1)
        <td class="data-tabel" style="color:orange;">{{ $web_app->appfunctionaladmins_count->count() }}</td>
        @else
        <td class="data-tabel" style="color:red;">{{ $web_app->appfunctionaladmins_count->count() }}</td>
        @endif
        <!--wijzig-->
        <td class="data-tabel"><a href="/apps/{{ $web_app->app_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <!--verwijder-->
        <td class="data-tabel">
        <form action="/apps/{{ $web_app->app_id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/apps">App Details</a> 
          <a href="/apps/?sort=app_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/appstatus">App Status</a>
          <a href="/apps/?sort=app_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/languages">Taal en Versie</a>
          <a href="/apps/?sort=language_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/frameworks">Framework en Versie</a>
          <a href="/apps/?sort=framework_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database</a>
          <a href="/apps/?sort=database_dependency"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Servers</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appowner">Aantal Eigenaars</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apptechadmin">Aantal Technisch Beheerders</a></th>
          <th class="rug-text-nowrap sortable"><a href="/appfunctionaladmin">Aantal Functioneel Beheerders</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $apps->links() }}
@endsection