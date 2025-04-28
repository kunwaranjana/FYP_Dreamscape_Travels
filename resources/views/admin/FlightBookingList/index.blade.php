@extends('admin.inc.main')

@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <div class="table-head">
        <h2>Flight Booking Details</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Reference Code</th>
                <th>Flight Number</th>
                <th>Airline</th>
                <th>From</th>
                <th>To</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Class</th>
                <th>Flight Price</th>
                <th>Booked By</th>
                <th>Passenger</th>
                <th>Payment Date</th>
                <th>Transaction code</th>
                <th>Payment Status</th>
                <th>Total Paid</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($flightBookings as $flightBooking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $flightBooking->reference_code }}</td>
                    <td>{{ $flightBooking->flight_number }}</td>
                    <td>{{ $flightBooking->airline_name }}</td>
                    <td>{{ $flightBooking->departure_airport }}</td>
                    <td>{{ $flightBooking->arrival_airport }}</td>
                    <td>{{ \Carbon\Carbon::parse($flightBooking->departure_datetime)->format('Y-m-d H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($flightBooking->arrival_datetime)->format('Y-m-d H:i') }}</td>
                    <td>{{ $flightBooking->travel_class }}</td>
                    <td>{{ $flightBooking->price }}</td>
                    <td>{{ $flightBooking->booked_by }}</td>
                    <td>{{ $flightBooking->passenger_name }}</td>
                    <td>{{ $flightBooking->payment_date }}</td>
                    <td>{{ $flightBooking->transaction_code }}</td>
                    <td>{{ ucfirst($flightBooking->payment_status) }}</td>
                    <td>RS {{ $flightBooking->payment_amount }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('passenger.edit', $flightBooking->passenger_id) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('flightBooking.delete', $flightBooking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dlt-btn" onclick="return confirm('Are you sure you want to delete this passenger?')">Delete</button>
                            </form>
                        </div>
                    </td>   
                </tr>
            @endforeach
        </tbody>
        
    </table>
    <div class="pagination-wrapper">
        {{ $flightBookings->links() }}
    </div>
    
</div>

@endsection
