<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Booking Form</title>
    <link href="{{ asset('assets/style.css')}}"  rel="stylesheet">
</head>
<body>
    
 @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 

    <div class="page-body">
        <div class="form-container">
            <h2>Booking Page</h2>
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
                
                
                {{-- @for ($i = 0; $i < $flightDetails['adults']; $i++)
                    <div class="passenger-group mb-3 p-3 border rounded">
                    
                        <div class="field">
                            <label for="passenger_name_{{ $i }}">Passenger Full Name</label>
                            <input type="text" class="form-control @error('passengers.' . $i . '.name') is-invalid @enderror" 
                                   id="passenger_name_{{ $i }}" name="passengers[{{ $i }}][name]" required>
                            @error('passengers.' . $i . '.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endfor --}}

                @for ($i = 0; $i < $flightDetails['adults']; $i++)
                <div class="field">
                    <label>Passenger {{ $i+1 }} Name:</label>
                    <input type="text" name="passengers[{{ $i }}][name]" required>
                </div>
            @endfor

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I understand and agree with the terms and conditions</label>
                </div>

                <div class="field">
                    <div class="field-btn">
                        <button type="button" onclick="window.history.back()">Back</button>
                        <button type="submit">Confirm</button>                    
                    </div>  
                </div>
                
            </form>

            {{-- <form action="{{ route('packageBooking.storeSecondForm', $package->id) }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    
                <div class="field">
                    <label for="title">Package Title</label>
                    <input type="text" id="title" name="title"  value="{{ $package->title }}" readonly>
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I understand and agree with the terms and conditions</label>
                </div>

                <div class="field">
                    <div class="field-btn">
                        <button type="button" onclick="window.history.back()">Back</button>
                        <button type="submit">Pay</button>                    
                    </div>  
                </div>      
                
            </form> --}}
        </div>
    </div>

</body>
</html>






