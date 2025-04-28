<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f8fc; 
            font-family: Arial, sans-serif;
        }

        .receipt {
            background: #fff;
            width: 700px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .receipt-header {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .esewa-logo {
            position: absolute;
            left: 15px;
            width: 120px;
        }

        .receipt-body{
            padding: 0 20px;
        }

        /* Row Layout */
        .row {
            display: flex;
            justify-content: space-between;
        }

        .left {
            width: 55%;
            text-align: left;
        }

        .left> h2{
            color: rgb(237, 97, 75);
            font-size: 22px;
        }

        .right {
            width: 40%;
            text-align: left;
            margin-right: 0;
        }
        
        .dot-border{
            border-top: 1px dashed #a7a4a4;
        
        }

        .receipt-footer {
            text-align: center;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }

        .hmm{
            width: 25%;
            text-align: left;
            margin-right: 0;
        }

        .pay-page-btn {
            display: flex;
            justify-content: space-between;  /* Flexbox to align the buttons */
            align-items: center;
            margin-top: 20px;
        }

        .pay-page-btn a{
            text-decoration: none;
        }

        .pay-page-btn a button{
            padding: 8px 13px;
            border-radius: 10px;
            background-color: #4489ba;
            border: 1px solid #4489ba;
            color: white;
            text-align: center;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <section class="success-page">
        <div class="receipt">
            <div class="receipt-header">
                <img src="/Image/Esewa_logo.webp" alt="Esewa Logo" class="esewa-logo"> 
                <h2>Payment Receipt</h2>
            </div>

            <div class="receipt-body">
                <div class="row">
                    <div class="left">
                        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Contact:</strong> {{ auth()->user()->contact }}</p>
                    </div>
                    <div class="right">
                        <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</p>

                        {{-- <p><strong>Payment Date:</strong> {{ $payment->payment_date->format('d M Y') }}</p> --}}
                        <p><strong>Transaction Code:</strong> {{ $payment->transaction_code }}</p>
                    </div>
                </div>

                <!-- Second Row (Package Details & Payment Details) -->
                <div class="row">
                    <div class="left">
                        <!-- <h2><strong>Package Details:</strong></h2> -->
                        <p><strong>Package Name:</strong> {{ $package->title }}</p>
                        <p><strong>Price Per Person:</strong> Rs {{ number_format($booking->package->price, 2) }}</p>
                        <p><strong>No. of Traveler:</strong> {{ $booking->travelerCount }}</p>
                        <p><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }}</p>
                        <p><strong>Total Amount:</strong> {{ number_format($booking->package->price * $booking->travelerCount, 2) }}</p>
                    </div>
                </div>

                <div class="row dot-border">
                    <div class="left"></div>
                    <div class="right hmm">
                        <p><strong>Paid:</strong> Rs {{ number_format($booking->package->price * $booking->travelerCount, 2) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
                        <p><strong>Method:</strong> Esewa</p>
                    </div>
                </div>
            </div>

            <div class="receipt-footer">
                <p>Thank you for booking with Dreamscape Travels!</p>
            </div>
        </div>
    </section>
</body>
</html>
 

