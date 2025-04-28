<?php

namespace App\Http\Controllers;

use App\Models\PackagePayment;
use App\Models\PackageBooking;
use Illuminate\Http\Request;
use Xentixar\EsewaSdk\Esewa;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Initiates the eSewa payment process for a specific booking
    public function pay($booking_id)
    {
        // Fetch the package booking details by booking ID
        $booking = PackageBooking::findOrFail($booking_id);

        // Generate a unique transaction ID (10-character hexadecimal string)
        $transaction_id = strtoupper(bin2hex(random_bytes(5)));

        // Store the booking ID in session for use after payment
        session(['booking_id' => $booking->id]);
        
        // Create an instance of the Esewa SDK
        $esewa = new Esewa();

        // Configure eSewa with:
        // - Success callback route
        // - Failure callback route
        // - Payment amount
        // - Generated transaction ID
        $esewa->config(
            route('esewa.check'),  // Success URL
            route('esewa.check'),  // Failure URL
            $booking->amount,      // Amount to be paid
            $transaction_id        // Unique transaction ID
        );

        // Redirect user to the eSewa payment gateway esewa page open hunxa
        return $esewa->init();
    }

    // Handles the callback from eSewa after the user completes payment
    public function check()
    {
        // Create an instance of the Esewa SDK
        $esewa = new Esewa();

        // Decode the response received from eSewa
        $data = $esewa->decode();
        //dd($data);

        // Check if the response is valid and the payment status is 'COMPLETE'
        if ($data && isset($data['status']) && $data['status'] === 'COMPLETE') {

            // Retrieve the booking ID stored in the session
            $booking_id = session('booking_id');

            // Proceed only if booking ID is present
            if ($booking_id) {

                // Fetch the corresponding booking record from the database
                $booking = PackageBooking::with('package')->find($booking_id);



                // Proceed if the booking is valid
                if ($booking) {

                    // Insert a new record in the 'payments' table
                    $payment = PackagePayment::create([
                        'user_id' => Auth::id(),                      // Logged-in user ID
                        'package_booking_id' => $booking->id,         // Related booking ID
                        'payment_date' => now(),                      // Current timestamp
                        'transaction_code' => $data['transaction_code'], // Transaction code from eSewa
                        'amount' => $booking->amount,                 // Payment amount
                        'status' => 'completed',                      // Payment status
                        'method' => 'esewa',                          // Payment method
                    ]);

                    // Clear the session data for booking ID
                    session()->forget('booking_id');

                    // Show success page with payment, booking, and package details
                    return view('payment.success', [
                        'payment' => $payment,
                        'booking' => $booking,
                        'package' => $booking->package
                    ]);
                }
            }

            // If booking ID is invalid or not found, redirect to payment failed page
            return redirect()->route('payment.failed')->with('error', 'Please try again');
        }

        // If payment failed or status is not COMPLETE, redirect to payment failed page
        return redirect()->route('payment.failed')->with('error', 'We were unable to process your payment. ');
   
    }   
}
