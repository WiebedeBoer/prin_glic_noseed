@if(session()->has('message'))
<div>
    <div class="rug-clearfix rug-theme--content rug-mb">
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
        </div>                   
    </div>
</div>
@endif