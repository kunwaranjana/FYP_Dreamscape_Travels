<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="page-body">
        <div class="form-container">
            <h2>Payment Page</h2>
            {{-- <p class="form-sub-head">Total Amount: Rs {{ $booking->price }} {{ $booking->currency }}</p> --}}

            <form action="{{ route('flight.processPayment') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="field">
                    <label for="card_name">Card Holder Name</label>
                    <input type="text" id="card_name" name="card_name" value="{{ old('card_name') }}">
                    @error('card_name')
                          <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="card_number">Card Number</label>
                    <input type="text" id="card_number" name="card_number" maxlength="16" value="{{ old('card_number') }}">
                    @error('card_number')
                          <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="month" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
                         <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="cvv">CVV</label>
                    <input type="password" id="cvv" name="cvv" maxlength="4" >
                    @error('cvv')
                          <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I understand and agree with the terms and conditions.</label>
                </div>

                <div class="field-btn">
                    <button type="button" onclick="window.history.back()">Back</button>
                    <button type="submit">Pay</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
