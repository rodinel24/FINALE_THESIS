<!-- index.blade.php -->

<h1>Reservation List</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->start_date }}</td>
                <td>{{ $reservation->end_date }}</td>
                <td>{{ $reservation->confirmed ? 'Confirmed' : 'Pending' }}</td>
                <td>
                    @if ($reservation->image)
                    <img src="{{ asset('storage/app/reservation_images'. $reservation->image) }}" width="120px" alt="">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    @if (!$reservation->confirmed)
                        <form action="{{ route('reservations.confirm', $reservation) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit">Confirm</button>
                        </form>
                    @endif
                    <form action="{{ route('reservations.reject', $reservation) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
