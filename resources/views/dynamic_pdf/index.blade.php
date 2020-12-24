@extends('layouts.app')
@section('title')
Server Data
@endsection
@section('content')
<div class="rug-panel--content rug-panel--content--border">
<h1 class="rug-mb-0 rug-clearfix">Server Data</h1>
</div>
<div class="rug-clearfix rug-theme--content rug-mb">
<p><a href="/dynamic_pdf/pdf">Load PDF</a></p>
</div>
<div class="rug-clearfix rug-theme--content rug-mb">
<table class="table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server Naam</th>
          <th class="rug-text-nowrap sortable">Server Type</th>
          <th class="rug-text-nowrap sortable">Server OTAP</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $server_data)
        <tr class="clickable-row">    
        <td class="data-tabel">
       {{ $server_data->server_name }}
        </td> 
        <td class="data-tabel">
        {{ $server_data->server_type }}
        </td> 
        <td class="data-tabel">
        {{ $server_data->server_otap }}
        </td> 
        </tr>  
    @endforeach
    </tbody>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server Naam</th>
          <th class="rug-text-nowrap sortable">Server Type</th>
          <th class="rug-text-nowrap sortable">Server OTAP</th>
        </tr>
    </thead>
</table>
</div>
@endsection