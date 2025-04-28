<?php

namespace App\Http\Controllers;

use App\Models\Flights;
use Illuminate\Http\Request;
use App\Services\AmadeusService;
use Illuminate\Support\Facades\Log;
use App\Models\FlightBooking;
use App\Models\Passenger;
use App\Models\FlightPayment;
use Illuminate\Support\Str;
use Amadeus\Exceptions\ResponseException;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function index()
    {
        return view('pages.home');
    }

    public function search(Request $request)
    {
        // Step 1: Validate user input
        $request->validate([
            'from_city' => 'required|different:to_city',
            'to_city' => 'required',
            'departureDate' => 'required|date|after_or_equal:today',
            'returnDate' => 'nullable|date|after:departureDate',
            'adults' => 'required|integer|min:1|max:5',
        ]);
    
        // Step 2: Determine if it's a one-way or two-way trip
        $returnDate = $request->input('way') === 'two_way' ? $request->input('returnDate') : null;
    
        // Step 3: Call Amadeus API
        $flights = $this->amadeusService->searchFlights(
            $request->input('origin'),
            $request->input('destination'),
            $request->input('departureDate'),
            $returnDate,
            $request->input('adults'),
        );
    
        Log::info($flights);
    
        // Step 4: Error Handling
        if (isset($flights['error'])) {
            return view('pages.flights.results', ['flights' => $flights, 'searchParams' => $request->all()]);
        }
    
        $flightDetails = [];
    
        foreach ($flights as $flight) {
            $itinerary = $flight->getItineraries()[0];
            $segments = $itinerary->getSegments();
            

            $firstSegment = $segments[0];
            $lastSegment = end($segments);
    
            // Travel class
            $travelClass = '';
            if (!empty($flight->getTravelerPricings())) {
                $fareDetails = $flight->getTravelerPricings()[0]->getFareDetailsBySegment();
                if (!empty($fareDetails)) {
                    $travelClass = $fareDetails[0]->getCabin();
                }
            }
    
            $airlineCode = $firstSegment->getCarrierCode();
            $airlineName = $this->amadeusService->getAirlineName($airlineCode);
    
            $durationRaw = $itinerary->getDuration();
            $duration = $this->formatDuration($durationRaw);
    
            $flightDetails[] = [
                'flightNumber' => $firstSegment->getNumber(),
                'airlineName' => $airlineName,

                //only one way
                'departureAirport' => $firstSegment->getDeparture()->getIataCode(),
                'arrivalAirport' => $lastSegment->getArrival()->getIataCode(),
                'departureDateTime' => $firstSegment->getDeparture()->getAt(),
                'arrivalDateTime' => $lastSegment->getArrival()->getAt(),

                'travelClass' => $travelClass,
                'price' => round($flight->getPrice()->getTotal()),
                'currency' => $flight->getPrice()->getCurrency(),
                'duration' => $duration,
            ];
        }
        

        if (empty($flightDetails)) {
            $message = 'No flights available from ' . $request->from_city . ' to ' . $request->to_city . ' on ' . $request->departureDate . '.';
            return view('pages.flights.flightList', compact('message'));
        }

        return view('pages.flights.flightList', ['flightDetails' => $flightDetails, 'searchParams' => $request->all()]);
    }

    
    private function formatDuration($duration)
    {
        preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?/', $duration, $matches);
        $hours = isset($matches[1]) ? (int)$matches[1] : 0;
        $minutes = isset($matches[2]) ? (int)$matches[2] : 0;
        return sprintf('%02dH:%02dM', $hours, $minutes);
    }

   
    
    public function showPassengerForm(Request $request)
    {
        $request->validate([
            'flight_number' => 'required',
            'airline_name' => 'required',
            'departure_airport' => 'required',
            'arrival_airport' => 'required',
            'departure_datetime' => 'required',
            'arrival_datetime' => 'required',
            'travel_class' => 'required',
            'price' => 'required|numeric',
            'currency' => 'required',
            'adults' => 'required|integer|min:1|max:5',
        ]);

        $flightDetails = $request->all();
        
        return view('pages.flights.passengerForm', compact('flightDetails'));
    }

    public function showPaymentForm($id)
    {
        $booking = FlightBooking::with('passengers')->findOrFail($id);
        return view('pages.flights.payment', compact('booking'));
    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:flight_bookings,id',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expiry_date' => 'required|date',
            'cvv' => 'required|digits_between:3,4',
        ]);

    $booking = FlightBooking::with('passengers')->find($request->booking_id);

    // Generate a unique transaction code
    $transactionCode = strtoupper(Str::random(5));
    
    // Save payment
    $payment = FlightPayment::create([
        'flight_booking_id' => $booking->id,
        'transaction_code' => $transactionCode,
        'payment_date' => now(), 
        'card_name' => $request->card_name,
        'card_number' => substr($request->card_number, -4),
        'payment_method' => 'Card',
        'status' => 'completed',
        'amount' => $booking->price,
        'currency' => $booking->currency,
    ]);

    return view('pages.flights.bookingconfirmation', compact('booking', 'payment'));

    // return view('pages.flights.payment', compact('booking', 'payment'));
    }
    


// mygoodness kati garo ho 
    public function confirmBooking(Request $request)
    {
        // Validate the flight details
        $request->validate([
            'flight_number' => 'required',
            'airline_name' => 'required',
            'departure_airport' => 'required',
            'arrival_airport' => 'required',
            'departure_datetime' => 'required',
            'arrival_datetime' => 'required',
            'travel_class' => 'required',
            'price' => 'required|numeric',
            'currency' => 'required',
            'passengers' => 'required|array|min:1',
            'passengers.*.name' => 'required|string|max:255',
        ]);
        
        // Generate a unique reference code
        $referenceCode = 'F' . strtoupper(Str::random(5));
        
        // Create the flight booking
        $booking = FlightBooking::create([
            'reference_code' => $referenceCode,
            'flight_number' => $request->flight_number,
            'airline_name' => $request->airline_name,
            'departure_airport' => $request->departure_airport,
            'arrival_airport' => $request->arrival_airport,
            'departure_datetime' => $request->departure_datetime, 
            'arrival_datetime' => $request->arrival_datetime,
            'travel_class' => $request->travel_class,
            'price' => $request->price,
            'currency' => $request->currency,
            'user_id' => auth()->id(),
        ]);
        
        // Create passenger records
        foreach ($request->passengers as $passengerData) {
            Passenger::create([
                'flight_booking_id' => $booking->id,
                'name' => $passengerData['name'],
            ]);
        }
        
        // Load the booking with its passengers for the view
        $booking = FlightBooking::with('passengers')->find($booking->id);
    
        return redirect()->route('flight.showPaymentForm', ['id' => $booking->id]);

        //return view('pages.flights.payment', compact('booking'));

       // return view('pages.flights.bookingconfirmation', compact('booking'));
    }
    
}