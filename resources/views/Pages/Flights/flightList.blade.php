@extends('layouts.main')

@section('container')
<section class="flight-page-adjustment">
    <div class="flightpage-container">

        @if(isset($message))
            <div class="alert alert-warning" style="text-align: center; margin: 30px auto; font-size: 18px; height: 450px;">
                {{ $message }}
            </div>
        @elseif(isset($flightDetails) && count($flightDetails) > 0)
            @foreach ($flightDetails as $index => $flight)
                <div class="flight-card" onclick="toggleActive({{ $index }})" id="card-{{ $index }}">
                    <div class="airline">{{ $flight['airlineName'] }}</div>

                    <div class="flight-info">
                        <div class="flight-info-field">
                            <div class="label">From:</div>
                            <div class="value">{{ $flight['departureAirport'] }} - {{ \Carbon\Carbon::parse($flight['departureDateTime'])->format('D, M d H:i') }}</div>
                        </div>
                        <div class="flight-info-field">
                            <div class="label">To:</div>
                            <div class="value">{{ $flight['arrivalAirport'] }} - {{ \Carbon\Carbon::parse($flight['arrivalDateTime'])->format('D, M d H:i') }}</div>
                        </div>
                        <div class="flight-info-field">
                            <div class="label">Flight Number:</div>
                            <div class="value">{{ $flight['flightNumber'] }}</div>
                        </div>
                        <div class="flight-info-field">
                            <div class="label">Duration:</div>
                            <div class="value">{{ $flight['duration'] }}</div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="second-row">
                        <div class="price">Rs {{ $flight['price'] }}</div>
                        <div class="class">{{ ucfirst($flight['travelClass']) }} Class</div>
                    </div>

                    <div class="third-row">
                        <form action="{{ route('flights.passenger-form') }}" method="POST">
                            @csrf
                            <input type="hidden" name="flight_number" value="{{ $flight['flightNumber'] }}">
                            <input type="hidden" name="airline_name" value="{{ $flight['airlineName'] }}">
                            <input type="hidden" name="departure_airport" value="{{ $flight['departureAirport'] }}">
                            <input type="hidden" name="arrival_airport" value="{{ $flight['arrivalAirport'] }}">
                            <input type="hidden" name="departure_datetime" value="{{ $flight['departureDateTime'] }}">
                            <input type="hidden" name="arrival_datetime" value="{{ $flight['arrivalDateTime'] }}">
                            <input type="hidden" name="travel_class" value="{{ $flight['travelClass'] }}">
                            <input type="hidden" name="price" value="{{ $flight['price'] }}">
                            <input type="hidden" name="currency" value="{{ $flight['currency'] }}">
                            <input type="hidden" name="adults" value="{{ $searchParams['adults'] }}">
                            <button type="submit" class="bookbtn">Book</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning" style="text-align: center; margin: 30px auto; font-size: 18px;">
                No flight data available.
            </div>
        @endif

    </div>

    <script>
        function toggleActive(index) {
            const cards = document.querySelectorAll('.flight-card');
            cards.forEach(card => card.classList.remove('active'));

            const selectedCard = document.getElementById(`card-${index}`);
            selectedCard.classList.add('active');
        }
    </script>
</section>
@endsection
