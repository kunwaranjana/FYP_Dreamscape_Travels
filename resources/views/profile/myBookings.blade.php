<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f8fc;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .booking-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            max-width: 600px;
        }

        .booking-card img.logo {
            width: 130px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .booking-card h3 {
            margin-top: 0;
            color: #555;
            font-size: 28px;
        }

        .booking-card p {
            margin: 8px 0;
        }

        .booking-card i {
            margin-right: 25px;
            color: #555;
            /* yo p tag lai align rakna lekehko hai */
            width:5px;    
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .cancel-btn:hover {
            background-color: #d32f2f;
        }

        .home-btn{
            padding: 8px 13px;
            border-radius: 10px;
            background-color: #4489ba;
            border: 1px solid #4489ba;
            color: white;
            text-align: center;
            cursor: pointer;
            font-size: 18px;
        }


        #cancelModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        } 
        
        #modalContent {
            background-color: white;
            padding: 20px;
            text-align: center;
            width: 400px;
            border-radius: 10px;
            position: absolute;
            top: 30%;
            left: 35%;
        }


        #modalContent img {
            width: 130px;
            margin-bottom: 20px;
        }

        .close-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="my-booking-container">
    <h1>My Bookings</h1>

    @if($bookingDetails->isEmpty())
        <p>You have not booked any packages yet.</p>
    @else
    @foreach ($bookingDetails as $booking)
    <div class="booking-card">
        <img src="/Image/logo.png" alt="Company Logo" class="logo">
        <h3>{{ $booking->title }}</h3>
        <p><i class="fas fa-calendar-alt"></i> <strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }}</p>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Destination:</strong> {{ $booking->destination }}</p>
        <p><i class="fas fa-clock"></i> <strong>Duration:</strong> {{ $booking->duration }} days</p>
        <p><i class="fas fa-tag"></i> <strong>Price:</strong> Rs {{ $booking->price }}</p>
        <p><i class="fas fa-users"></i> <strong>Traveler Count:</strong> {{ $booking->travelerCount }}</p>
        <p><i class="fas fa-money-bill"></i> <strong>Total Amount:</strong> Rs {{ $booking->amount }}</p>
        <p><i class="fas fa-barcode"></i> <strong>Transaction Code:</strong> {{ $booking->transaction_code }}</p>
        <p><i class="fas fa-calendar-check"></i> <strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($booking->payment_date)->format('d M, Y') }}</p>
        <p><i class="fas fa-credit-card"></i> <strong>Payment Method:</strong> {{ $booking->payment_method }}</p>
        <p><i class="fas fa-check-circle"></i> <strong>Payment Status:</strong> {{ $booking->payment_status }}</p>
        <button class="cancel-btn" onclick="toggleModal()">Cancel Booking</button>
    </div>
@endforeach

    @endif

    <!-- Go to Home Button -->
    <div style="text-align: center;">
        <button class="home-btn" onclick="window.location.href='/home';">Go to Home</button>
    </div>
</div>

<!-- Modal for Cancellation -->
<div id="cancelModal">
    <div id="modalContent">
        <h2>Cancellation Request</h2>
        <p>If you want to cancel your booking, please contact us.</p> 
        <ul style="list-style-type: none; padding:8px; text-align: left;">
            <li><i class="fas fa-phone"> </i> 977 9824115186 </li>
            <li><i class="fas fa-envelope"> </i> DreamscapeTravels2024@gmail.com</li>
        </ul>
        {{-- <img src="/Image/logo.png"  alt="Dreamscape Logo"> --}}
        <br><br>
        <button class="close-btn" onclick="toggleModal()">Close</button>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById("cancelModal");
        modal.style.display = (modal.style.display === "block") ? "none" : "block";
    }
</script>

</body>
</html>
