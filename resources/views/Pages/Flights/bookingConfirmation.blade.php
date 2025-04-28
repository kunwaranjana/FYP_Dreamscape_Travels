<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f8fc; 
            margin: 0;
            padding: 0;
        }

        .center-main-card {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .alert-success {
            background-color: #d4edda;
            padding: 15px 20px;
            font-size: 1.1rem;
            color: #155724;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .flight-details-card {
            background: #f4f6f8;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        
        .title {
            color: #0077cc;
            font-weight: bold;
            font-size: 23px;
            margin-bottom: 15px;
            margin-top: 0;
        }

        .details-card {
            background: #f4f6f8;
            display: flex;
            flex-wrap: wrap;
            row-gap: 20px;

        }

        .info-block {
            flex: 1 1 45%;
        }

        .label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 20px;
        }

        .value {
            color: #34495e;
            font-size: 16px;
        }

        .passenger-detail-card {
            background: #f4f6f8;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .passenger-detail-card ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .passenger-detail-card li {
            list-style: disc;
            color: #2c3e50;
            font-size: 1rem;
        }

        .payment-detail-card {
            background: #f4f6f8;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }


        .action-btn {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 10px;
            background-color: #4489ba;
            border: 1px solid #4489ba;
            color: white;
            text-decoration: none;
            margin: 10px;
            transition: background 0.3s ease;
        }

    </style>
</head>
<body>

    <div class="center-main-card">
        <div class="alert-success">
            Your booking has been confirmed with reference code: <strong>{{ $booking->reference_code }}</strong>
        </div>

      
        <div class="flight-details-card">
            <h4 class="title">Flight Details</h4>
            <div class="details-card">
                <div class="info-block">
                    <div class="label"> Airline:</div>
                    <div class="value">{{ $booking->airline_name }}</div>
                </div>
                <div class="info-block">
                    <div class="label">Flight Number:</div>
                    <div class="value">{{ $booking->flight_number }}</div>
                </div>
                <div class="info-block">
                    <div class="label">From:</div>
                    <div class="value">
                        {{ $booking->departure_airport }} - 
                        {{ \Carbon\Carbon::parse($booking->departure_time)->format('D, M d H:i') }}
                    </div>
                </div>
                <div class="info-block">
                    <div class="label"> To:</div>
                    <div class="value">
                        {{ $booking->arrival_airport }} - 
                        {{ \Carbon\Carbon::parse($booking->arrival_time)->format('D, M d H:i') }}
                    </div>
                </div>
                <div class="info-block">
                    <div class="label">Class:</div>
                    <div class="value">{{ ucfirst($booking->travel_class) }} Class</div>
                </div>
                <div class="info-block">
                    <div class="label">Price:</div>
                    <div class="value">Rs {{ $booking->price }}</div>
                </div>
            </div>
        </div>

        
        <div class="passenger-detail-card">
            <h4 class="title">Passenger Details</h4>
            <ul>
                @foreach($booking->passengers as $passenger)
                    <li>{{ $passenger->name }}</li>
                @endforeach
            </ul>
        </div>

        @if(isset($payment))
        <div class="payment-detail-card">
            <h4 class="title">Payment Details</h4>
            <div class="details-card">
                <div class="info-block">
                    <div class="label">Transaction Code:</div>
                    <div class="value">{{ $payment->transaction_code }}</div>
                </div>
                <div class="info-block">
                    <div class="label">Card Used:</div>
                    <div class="value">**** **** **** {{ $payment->card_number }}</div>
                </div>
                <div class="info-block">
                    <div class="label">Payment Method:</div>
                    <div class="value">{{ $payment->payment_method }}</div>
                </div>
                <div class="info-block">
                    <div class="label">Status:</div>
                    <div class="value">{{ ucfirst($payment->status) }}</div>
                </div>
                <div class="info-block">
                    <div class="label">Payment date</div>
                    <div class="value">Payment Date: {{ $payment->payment_date }}</div>

                </div>
                <div class="info-block">
                    <div class="label">Amount Paid:</div>
                    <div class="value">Rs {{ $payment->amount }}</div>
                </div>
            </div>
        </div>
        @endif

        <div class="action-btn">
            <a href="{{ route('home') }}" class="btn">Return to Home</a>
            <a href="{{ route('booking.downloadPDF', $booking->id) }}" class="btn">Download PDF</a>
        </div>

    </div>

</body>
</html>
