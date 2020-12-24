<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">

<h2>App Library dependencies binnen Framework</h2>
<!--app libraries dependencies-->
<div>
<h3>App Library dependencies binnen Framework</h3>
<p>
@if($librarydependencycount >=1)
  @foreach($librarydependencies as $library_dependency)
    <a href="/libraries/{{$library_dependency->dependency_id }}">{{ $library_dependency->dependency_name }}</a><br>
  @endforeach
@endif 
</p>
</div>

</div>
</div>
</div>
</div>