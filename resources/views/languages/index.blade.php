@extends('layouts.appmain')
@section('title')
Language Types Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Language Types Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Language Type Afhankelijkheid Aanmaak</h2>
<p><a href="/languages/create" class="btn btn-primary">Voeg Language Type Afhankelijkheid toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Language Types Afhankelijkheden</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Language Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($languages as $language) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/languages/{{ $language->language_id }}">{{ $language->language_name }}</a></td> 
        <td class="data-tabel"><a href="/languages/{{ $language->language_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/languages/{{ $language->language_id }}" method="post">
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
        <th class="rug-text-nowrap sortable">Language Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $languages->links() }}
@endsection