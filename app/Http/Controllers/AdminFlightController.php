<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use App\Models\Passenger;


class AdminFlightController extends Controller
{
    public function index()
    {
        $flightBookings = DB::table('flight_bookings')
        ->join('passengers', 'flight_bookings.id', '=', 'passengers.flight_booking_id')
        ->join('users', 'flight_bookings.user_id', '=', 'users.id')
        ->join('flight_payments', 'flight_bookings.id', '=', 'flight_payments.flight_booking_id') // INNER JOIN
        ->select(
            'flight_bookings.id',
            'flight_bookings.reference_code',
            'flight_bookings.flight_number',
            'flight_bookings.airline_name',
            'flight_bookings.departure_airport',
            'flight_bookings.arrival_airport',
            'flight_bookings.departure_datetime',
            'flight_bookings.arrival_datetime',
            'flight_bookings.travel_class',
            'flight_bookings.price',
            // 'flight_bookings.currency',
            'users.email as booked_by',
            'passengers.name as passenger_name',
            'passengers.id as passenger_id', 
            'flight_payments.payment_date',
            'flight_payments.transaction_code',
            'flight_payments.status as payment_status',
            'flight_payments.amount as payment_amount'
        )
            // ->get();
            ->paginate(5);
    
        return view('admin.FlightBookingList.index', compact('flightBookings'));
    }


        
    public function editPassenger($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('admin.FlightBookingList.edit', compact('passenger'));
    }

    public function updatePassenger(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $passenger = Passenger::findOrFail($id);
        $passenger->name = $request->name;
        $passenger->save();

        return redirect()->route('flightBookingList.index')->with('success', 'Passenger name updated successfully.');
    }



    public function deleteFlightBooking($id)
    {
        $booking = FlightBooking::findOrFail($id);
        $booking->delete();  // Laravel will automatically delete related passengers and payments (because of CASCADE)
        
        return redirect()->route('flightBookingList.index')->with('success', 'Deleted successfully.');
    }

}



