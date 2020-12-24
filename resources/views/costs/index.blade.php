@extends('layouts.apptotals')
@section('title')
Kosten
@endsection
@section('pagename')
Kosten
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Export</h2>
<p><a href="{{url('costs.csv')}}" class="btn btn-primary" class="btn btn-primary">Print Excel</a></p>
@endsection
<!--content-->
@section('content')
<h2>Kosten</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a>
          <a href="/costs/?sort=server_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Server Kosten
          <a href="/costs/?sort=server_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Geheugen Kosten
          <a href="/costs/?sort=memory_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">SLA Kosten
          <a href="/costs/?sort=sla_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverstatus">Server Status</a>
          <a href="/costs/?sort=server_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverservice">Service Level</a>
          <a href="/costs/?sort=server_service"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Apps</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($servers as $registered_server)
        <tr>    
        <td class="data-tabel">
        <a href="/costs/{{ $registered_server->server_id }}">{{ $registered_server->server_name }}</a>
        </td> 
        <td class="data-tabel">{{ $registered_server->server_costs }}</td>
        <td class="data-tabel">{{ $registered_server->memory_costs }}</td>
        <td class="data-tabel">{{ $registered_server->sla_costs }}</td>
        <td class="data-tabel">{{ $registered_server->servers_status->server_status }}</td>
        <td class="data-tabel">{{ $registered_server->servers_service->server_service }}</td>
        <td class="data-tabel">{{ $registered_server->serverapps_count->count() }}</td>
        <td class="data-tabel">
        <a href="/servers/{{ $registered_server->server_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        <td class="data-tabel">
        <form action="/servers/{{ $registered_server->server_id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a>
          <a href="/costs/?sort=server_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Server Kosten
          <a href="/costs/?sort=server_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">Geheugen Kosten
          <a href="/costs/?sort=memory_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable">SLA Kosten
          <a href="/costs/?sort=sla_costs"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverstatus">Server Status</a>
          <a href="/costs/?sort=server_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverservice">Service Level</a>
          <a href="/costs/?sort=server_service"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Apps</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Totaal Aantal Servers</th>
          <th class="rug-text-nowrap sortable">Totale Server Kosten</th>
          <th class="rug-text-nowrap sortable">Totale Geheugen Kosten</th>
          <th class="rug-text-nowrap sortable">Totale SLA Kosten</th>
          <th class="rug-text-nowrap sortable">Totaal Soorten Status</th>
          <th class="rug-text-nowrap sortable">Totaal Soorten Service Level</th>
          <th class="rug-text-nowrap sortable">Totaal Aantal Apps</th>
          <th class="rug-text-nowrap sortable">&nbsp;</th>
          <th class="rug-text-nowrap sortable">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <tr>
          <td class="data-tabel">{{ $servers_count }}</td>
          <td class="data-tabel">{{ $sum_server_costs }}</td>
          <td class="data-tabel">{{ $sum_memory_costs }}</td>
          <td class="data-tabel">{{ $sum_sla_costs }}</td>
          <td class="data-tabel">{{ $status_count }}</td>
          <td class="data-tabel">{{ $service_count }}</td>
          <td class="data-tabel">{{ $apps_count }}</td>
          <td class="data-tabel">&nbsp;</td>
          <td class="data-tabel">&nbsp;</td>
        </tr>
    </tbody>
</table>
@endsection
@section('subtotals')
<div class="row">
<!--server kosten per status-->
<div class="col-12 d-flex justify-content-center pt-5">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
<h2>Kosten per Status</h2>
<table class="table table-striped">
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server Status</th>
          <th class="rug-text-nowrap sortable">Server kosten per Status</th>
          <th class="rug-text-nowrap sortable">Geheugen kosten per Status</th>
          <th class="rug-text-nowrap sortable">SLA kosten per Status</th>
        </tr>
    </thead>
    <tbody>    
@foreach($server_costs_per_status as $server_cost_per_status)
    <tr>
        <td class="data-tabel"><a href="/serverstatus/{{ $server_cost_per_status->servers_status->server_status_id }}">{{ $server_cost_per_status->servers_status->server_status }}</a></td>
        <td class="data-tabel">{{ $server_cost_per_status->servercosts }}</td>
        <td class="data-tabel">{{ $server_cost_per_status->memorycosts }}</td>
        <td class="data-tabel">{{ $server_cost_per_status->slacosts }}</td>
    </tr>
@endforeach
    </tbody>
</table>   
</div>
</div>
</div>
</div>
<!--server kosten per service-->
<div class="col-12 d-flex justify-content-center pt-5">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">
    <h2>Kosten per Service Level</h2>
<table class="table table-striped">
<thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server Service Level</th>
          <th class="rug-text-nowrap sortable">Server kosten per Service Level</th>
          <th class="rug-text-nowrap sortable">Geheugen kosten per Service Level</th>
          <th class="rug-text-nowrap sortable">SLA kosten per Service Level</th>
        </tr>
    </thead>
    <tbody>    
    @foreach($server_costs_per_service as $server_cost_per_service)
    <tr>
        <td class="data-tabel"><a href="/serverservice/{{ $server_cost_per_service->servers_service->server_service_id }}">{{ $server_cost_per_service->servers_service->server_service }}</a></td>
        <td class="data-tabel">{{ $server_cost_per_service->servercosts }}</td>
        <td class="data-tabel">{{ $server_cost_per_service->memorycosts }}</td>
        <td class="data-tabel">{{ $server_cost_per_service->slacosts }}</td>
    </tr>
@endforeach
    </tbody>
</table> 
</div>
</div>
</div>  
</div>

</div>
@endsection