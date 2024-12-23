@props(['visitors'])
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>IP Address</th>
            <th>User Agent</th>
            <th>Country</th>
            <th>City</th>
            <th>State</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($visitors as $x => $visitor)
            <tr>
                <th>{{ $x + 1 }}</th>
                <th>{{ $visitor['ip_address'] }}</th>
                <th>{{ $visitor['user_agent'] }}</th>
                <th>{{ $visitor['country'] }}</th>
                <th>{{ $visitor['city'] }}</th>
                <th>{{ $visitor['state'] }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="6" align="center">
                    -no data-
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
