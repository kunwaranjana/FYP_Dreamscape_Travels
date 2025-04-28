@extends('admin.inc.main')

@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <div class="table-head">
        <h2>Package Booking Details</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Package Name</th>
                <th>Price</th>
                <th>Traveler Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Traveler Count</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Transaction Code</th>
                <th>Payment Date</th>
                <th>Booking Date</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>

        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->title }}</td>
                    <td>Rs {{ $booking->price }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->contact }}</td>
                    <td>{{ $booking->travelerCount }}</td>
                    <td>Rs {{ $booking->amount }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->transaction_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->payment_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</td>
                    {{-- <td>
                        <div class="actions">
                            <a href="{{ route('packageBookingList.edit', $booking->id) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('packageBookingList.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dlt-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $bookings->links() }}
    </div>

</div>

@endsection
