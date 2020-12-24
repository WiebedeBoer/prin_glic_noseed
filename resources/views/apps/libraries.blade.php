<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">

<h2>Libraries</h2>
<!--app libraries-->
<div>
<h3>App Libraries</h3>
<p>
@if($librarycount >=1)
  @foreach($libraries as $app_library)
    <a href="/libraries/{{$app_library->library_id }}">{{ $app_library->dependency_name }}</a><br>
  @endforeach
@endif 
</p>
</div>

@if($dependentcount >=1)
<!--app dependent-->
<div>
<h3>Afhankelijke Apps</h3>
<p>

  @foreach($dependent as $dependency_app)
    App: <a href="/apps/{{$dependency_app->app_id }}">{{ $dependency_app->apps->app_name }}</a> 
    Afhankelijke App: <a href="/apps/{{$dependency_app->dependent_app_id }}">{{ $dependency_app->dependent_apps->app_name }}</a><br>
  @endforeach

</p>
</div>
@endif 

</div>
</div>
</div>
</div>