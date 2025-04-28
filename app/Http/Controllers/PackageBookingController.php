<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Models\Package;
use App\Models\User;
use App\Models\PackagePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageBookingController extends Controller
{

    public function showBookingForm($id)
    {
        $package = Package::findOrFail($id);
        return view('pages.packages.packageBookingForm', compact('package'));
    }

    public function storeFirstForm(Request $request, $id)
    {
        // Validate form input
        $request->validate([
            'travelerCount' => 'required|integer|min:1',
            'name' => 'required|string|max:40|regex:/^[a-zA-Z\s]+$/|',
            'email' => 'required|email|max:255',
            'contact' => 'required|numeric|digits:10',
            'booking_date' => 'required|date|after_or_equal:today'
        ]);

        // Retrieve the selected package
        $package = Package::findOrFail($id);

         // Store booking data in session temporarily
        session([
            'package_id' => $package->id,
            'travelerCount' => $request->travelerCount,
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'booking_date' => $request->booking_date
        ]);

        return redirect()->route('packageBooking.showSecondForm', ['id' => $id]);
    }


    public function showSecondForm($id)
    {
        // Retrieve stored values from session
        $travelerCount = session('travelerCount', 1);
        $bookingDate = session('booking_date');
        $package = Package::findOrFail($id);

        return view('pages.packages.packageBookingFormTwo', compact('package', 'travelerCount', 'bookingDate'));
    }

    public function storeSecondForm(Request $request, $id)
    {
        // Validate required fields
        $request->validate([
            'travelerCount' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:1',
        ]);

        // Save booking to database
        //INSERT INTO package_bookings (user_id, package_id, booking_date, travelerCount, amount) VALUES (?, ?, NOW(), ?, ?);

        $booking = PackageBooking::create([
            'user_id' => auth()->id(),
            'package_id' => $id,
            'booking_date' => session('booking_date'),
            'travelerCount' => $request->travelerCount,
            'amount' => $request->amount
        ]);

        //Redirect to home page
        //return redirect()->route('user-package.index')->with('success', 'Booking successfully created!');
        return redirect()->route('package.payment', ['booking_id' => $booking->id]);
    }


// ADMINSIDE CRUDE
    public function index()
    {
        $bookings = DB::table('package_bookings')
            ->join('packages', 'package_bookings.package_id', '=', 'packages.id')
            ->join('users', 'package_bookings.user_id', '=', 'users.id')
            ->join('package_payments', 'package_bookings.id', '=', 'package_payments.package_booking_id') // ✅ INNER JOIN ensures payment exists
            ->select(
                'package_bookings.id',
                'packages.title',
                'packages.price',
                'users.name',
                'users.email',
                'users.contact',
                'package_bookings.travelerCount',
                'package_bookings.amount',
                'package_payments.status',
                'package_payments.transaction_code',
                'package_payments.payment_date',
                'package_bookings.booking_date'
            )
            ->where('package_payments.status', 'completed') // 
            ->orderBy('package_bookings.id', 'desc')
            ->paginate(5);

        return view('admin.packageBookingList.index', compact('bookings'));
    }

    
      
}