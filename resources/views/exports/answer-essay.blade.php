<table>
    <thead>
        <tr>
            <th>Participant ID</th>
            <th>Answer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->participant_id }}</td>
                <td>{{ $item->content }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
