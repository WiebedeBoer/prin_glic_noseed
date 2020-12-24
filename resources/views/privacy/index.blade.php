@extends('layouts.appmain')
@section('title')
Privacy
@endsection
<!--name-->
@section('pagename')
Privacy
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('privacy.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Export</h2>
<p><a href="{{url('privacy.csv')}}" class="btn btn-primary" class="btn btn-primary">Print Excel</a></p>
@endsection
<!--content-->
@section('content')
<h2>Privacy</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
        <th class="rug-text-nowrap sortable"><a href="/apps">App Details</a>
        <a href="/privacy/?sort=app_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
        </th>
          <th class="rug-text-nowrap sortable"><a href="/appstatus">App Status</a>
          <a href="/privacy/?sort=app_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Privacy Status
          <a href="/privacy/?sort=privacy_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database Status</a></th>
          <th class="rug-text-nowrap sortable"><a href="/suppliers">Leveranciers</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($apps as $web_app)
        <tr>    
        <td class="data-tabel">
        <a href="/privacy/{{ $web_app->app_id }}">{{ $web_app->app_name }}</a>
        </td> 
        <!--app status-->
        <td class="data-tabel">{{ $web_app->apps_status->app_status }}</td>
        <!--privacy status-->
        <td class="data-tabel">{{ $web_app->privacy_status }}</td>
        <!--database-->
        <td class="data-tabel">{{ $web_app->apps_database->db_name }}</td>
        <!--leverancier-->
        <td class="data-tabel">
        @if($web_app->appsuppliers_count->count() >=1)
            @foreach($web_app->apps_person_supplier as $apps_person_supplier) 
                {{ $apps_person_supplier->apps_person_supplier->person_name }}
            @endforeach
        @endif
        </td>
        <!--wijzig-->
        <td class="data-tabel">
        <a href="/privacy/{{ $web_app->app_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        <td class="data-tabel">
        <form action="/privacy/{{ $web_app->app_id }}" method="post">
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
        <a href="/privacy/?sort=app_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
        </th>
          <th class="rug-text-nowrap sortable"><a href="/appstatus">App Status</a>
          <a href="/privacy/?sort=app_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Privacy Status
          <a href="/privacy/?sort=privacy_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database Status</a></th>
          <th class="rug-text-nowrap sortable"><a href="/suppliers">Leveranciers</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $apps->links() }}
@endsection