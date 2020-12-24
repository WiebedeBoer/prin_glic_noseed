@extends('layouts.appextra')
@section('title')
Roadmap Details voor {{ $roadmap->roadmap_update }}
@endsection
<!--name-->
@section('pagename')
Roadmap Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/roadmaps/{{ $roadmap->roadmap_id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--content-->
@section('content')
<h2>Roadmap Algemene Details</h2>
<ul class="nav navbar-nav">  

        <li class="nav-item">Update: {{ $roadmap->roadmap_update  }}</li>
        <li class="nav-item">Extern bord: <a href="{{ $roadmap->trello_board  }}">{{ $roadmap->trello_board  }}</a></li>
</ul>

@endsection
@section('addition')
<h2>Roadmap Delen</h2>

<div class="row"></div>

<div class="row">
<div class="col">

</div>
<div class="col">

</div>
</div>

<!--roadmap persons loop-->
@foreach($roadmappersons as $roadmapperson) 
        <div class="row">
                <div class="col">
              
                </div>
                <div class="col">
                {{$roadmapperson->types->roadmap_task}}
                </div>
                <div class="col">
                {{$roadmapperson->personnel->person_name}}       
                </div>
                <div class="col">
                        <svg width="1000" height="80">
<                       
                        <title>{{$roadmapperson->personnel->person_name}}</title>
                        <rect x="0" y="5" width="1000" height="70" style="fill:green;stroke:green;stroke-width:5;fill-opacity:0.1;stroke-opacity:0.9" />
                        @foreach($roadmapperson->tasks as $task)
                        {
                                
                                {{$xpos = Arr::get($task, 'xpos')}}
                                {{$xwidth = Arr::get($task, 'xwidth')}}
                                {{$tasktext = Arr::get($task, 'task')}}

                                <a xlink:href="/roadmaptypes/{{$roadmapperson->id}}">
                                <rect x="{{ $xpos }} " y="15" width="{{ $xwidth }}" height="50" style="fill:red;stroke:red;stroke-width:5;fill-opacity:0.1;stroke-opacity:0.9" />
                                <text x="{{ $xpos + 5 }}" y="40" fill="black">{{ $tasktext }}</text>
                                </a>  
                               
                        }
                        @endforeach

                        <!--browser support-->
                        Sorry, your browser does not support inline SVG.  
                        </svg>

                </div>
        </div>
@endforeach

@endsection