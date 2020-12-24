<table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Service</th>
                <th>Server Kosten</th>
                <th>Memory Kosten</th>
                <th>SLA Kosten</th>
            </tr>
            </thead>
            <tbody>
            @foreach($costs as $server)
                <tr>
                    <td>{{ $server->server_name }}</td>
                    <td>{{ $server->server_status }}</td>
                    <td>{{ $server->server_service }}</td>
                    <td>{{ $server->server_costs }}</td>
                    <td>{{ $server->memory_costs }}</td>
                    <td>{{ $server->sla_costs }}</td>
                </tr>
            @endforeach
            </tbody>
  </table>