<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">

<h2>Apps</h2>
<!--apps-->
<div>
<h3>Apps</h3>
<p>
@if($serverappcount >=1)
  @foreach($serverapps as $app_server)
    <a href="/apps/{{$app_server->app_id }}">{{ $app_server->apps->app_name }}</a><br>
  @endforeach
@endif 
</p>
</div>

</div>
</div>
</div>
</div>