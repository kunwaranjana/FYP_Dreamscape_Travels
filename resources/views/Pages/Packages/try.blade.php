
@extends('layouts.main')
@section('container')
<section class="passenger-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Passenger Details</h2>
                    </div>
                    <div class="card-body">
                        
                        <form action="{{ route('flights.confirm-booking') }}" method="POST">
                            @csrf
                            
                            <!-- Hidden flight details to pass to next step -->
                            <input type="hidden" name="flight_number" value="{{ $flightDetails['flight_number'] }}">
                            <input type="hidden" name="airline_name" value="{{ $flightDetails['airline_name'] }}">
                            <input type="hidden" name="departure_airport" value="{{ $flightDetails['departure_airport'] }}">
                            <input type="hidden" name="arrival_airport" value="{{ $flightDetails['arrival_airport'] }}">
                            <input type="hidden" name="departure_datetime" value="{{ $flightDetails['departure_datetime'] }}">
                            <input type="hidden" name="arrival_datetime" value="{{ $flightDetails['arrival_datetime'] }}">
                            <input type="hidden" name="travel_class" value="{{ $flightDetails['travel_class'] }}">
                            <input type="hidden" name="price" value="{{ $flightDetails['price'] }}">
                            <input type="hidden" name="currency" value="{{ $flightDetails['currency'] }}">
                            
                            <h4>Passenger Information</h4>
                            
                            @for ($i = 0; $i < $flightDetails['adults']; $i++)
                                <div class="passenger-group mb-3 p-3 border rounded">
                                    <h5>Passenger {{ $i + 1 }}</h5>
                                    <div class="form-group">
                                        <label for="passenger_name_{{ $i }}">Full Name</label>
                                        <input type="text" class="form-control @error('passengers.' . $i . '.name') is-invalid @enderror" 
                                               id="passenger_name_{{ $i }}" name="passengers[{{ $i }}][name]" required>
                                        @error('passengers.' . $i . '.name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endfor
                            
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Continue to Confirmation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection













