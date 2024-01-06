<div>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $rentLog)
                <tr>
                    <td
                        class="{{ $rentLog->actual_return_date == null ? '' : ($rentLog->return_date < $rentLog->actual_return_date ? 'bg-danger' : 'bg-success') }}">
                        {{ $loop->iteration }}</td>
                    <td>{{ $rentLog->user->username }}</td>
                    <td>
                        @if ($rentLog->book)
                            {{ $rentLog->book->title }}
                        @else
                            No book data available
                        @endif
                    </td>
                    <td>{{ $rentLog->rent_date }}</td>
                    <td>{{ $rentLog->return_date }}</td>
                    <td>{{ $rentLog->actual_return_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
