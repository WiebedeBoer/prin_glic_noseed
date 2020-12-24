<table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <a href="{{url('/privacy/export')}}"> export</a>
            @foreach($privacy as $app)
                <tr>
                    <td>{{ $app->app_name }}</td>
                    <td>{{ $app->privacy_status }}</td>
                </tr>
            @endforeach
            </tbody>
  </table>