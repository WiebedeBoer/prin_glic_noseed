@extends('layouts.appmain')
@section('title')
Framework Types Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Framework Types Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Framework Type Afhankelijkheid Aanmaak</h2>
<p><a href="/frameworks/create" class="btn btn-primary">Voeg Framework Type Afhankelijkheid toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Framework Types Afhankelijkheden</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Framework Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($frameworks as $framework) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/frameworks/{{ $framework->framework_id }}">{{ $framework->framework_name }}</a></td> 
        <td class="data-tabel"><a href="/frameworks/{{ $framework->framework_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/frameworks/{{ $framework->framework_id }}" method="post">
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
        <th class="rug-text-nowrap sortable">Framework Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $frameworks->links() }}
@endsection