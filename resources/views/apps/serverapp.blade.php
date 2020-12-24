<div class="rug-clearfix rug-theme--content rug-mb">
<div class="project-more-info">
<div class="project-period-items">
<div class="project-period-item">

<h2>Servers</h2>
<!--servers-->
<div>
<h3>Servers</h3>
<p>
@if($serverappcount >=1)
  @foreach($serverapps as $app_server)
    <a href="/servers/{{$app_server->server_id }}">{{ $app_server->servers->server_name }}</a><br>
  @endforeach
@endif 
</p>
</div>

</div>
</div>
</div>
</div>