@component('mail::message',['server_status' => $server_status,'server_name' => $server_name])

Beste,
De server {{$server_name}} statis is veranderd naar {{$server_status}}.

PRIN6
@endcomponent