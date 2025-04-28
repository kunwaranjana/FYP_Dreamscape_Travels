<?php

namespace App\Http\Controllers;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use App\Models\FlightBooking;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\PackagePayment;
use Illuminate\Http\Request;

class pdfGenerateController extends Controller
{
    public function downloadFlightBookingPDF($id)
    {
        $booking = FlightBooking::with('passengers')->findOrFail($id);

        $pdf = Pdf::loadView('pages.flights.bookingConfirmation', compact('booking'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('booking-confirmation.pdf');
    }

    public function downloadPaymentReceipt($id)
{
    // Find the payment using the provided ID
    $payment = PackagePayment::findOrFail($id);

    // Access the related PackageBooking and then the Package
    $booking = $payment->PackageBooking;
    $package = $booking->Package;

    // Generate the PDF using the payment, booking, and package data
    $pdf = Pdf::loadView('payment.paymentReceipt', compact('payment', 'booking', 'package'))
              ->setPaper('A4', 'portrait');

    return $pdf->download('payment_receipt.pdf');
    }



}
