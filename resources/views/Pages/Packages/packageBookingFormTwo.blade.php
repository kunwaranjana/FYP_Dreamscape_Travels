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
            <form action="{{ route('packageBooking.storeSecondForm', $package->id) }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">


                <div class="field">
                    <label for="title">Package Title</label>
                    <input type="text" id="title" name="title"  value="{{ $package->title }}" readonly>
                </div>

                <div class="field">
                    <label for="booking_date">Booking Date</label>
                    <input type="text" id="booking_date" name="booking_date" value="{{ \Carbon\Carbon::parse($bookingDate)->format('d M, Y') }}" readonly>
                </div>
                

                <div class="field">
                    <label for="travelerCount">No. Of Travelers</label>
                    <input type="number" id="travelerCount" name="travelerCount" value="{{ $travelerCount }}" readonly>
                </div> 

                <div class="field">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}">
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" >
                </div>

                <div class="field">
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" name="contact" value="{{ auth()->user()->contact }}" >
                </div>

                <div class="field">
                    <label for="totalAmount">Total Amount</label>
                    <input type="number" id="totalAmount" name="amount" value="{{ $package->price * $travelerCount }}" readonly>
                </div>
    
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I understand and agree with the terms and conditions.</label>
                </div>

                <div class="field">
                    <div class="field-btn">
                        <button type="button" onclick="window.history.back()">Back</button>
                        <button type="submit">Pay</button>                    
                    </div>  
                </div>      
                
            </form>
        </div>
    </div>

</body>
</html>














