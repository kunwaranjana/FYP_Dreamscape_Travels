<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact' => ['nullable', 'string', 'max:10'],
        ]);

        $user->update($validated);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        auth()->logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function myBookings()
    {
         // Get the logged-in user
        $user = Auth::user();
        
        $bookingDetails = DB::table('package_bookings')
        ->join('packages', 'package_bookings.package_id', '=', 'packages.id')
        ->join('package_payments as payments', 'package_bookings.id', '=', 'payments.package_booking_id') // 👈 Alias created
        ->where('payments.status', 'completed')
        ->where('package_bookings.user_id', $user->id)
        ->select(
            'packages.title',
            'packages.destination',
            'packages.duration',
            'packages.price',
            'package_bookings.booking_date',
            'package_bookings.travelerCount',
            'package_bookings.amount',
            'payments.transaction_code',
            'payments.status as payment_status',
            'payments.method as payment_method',
            'payments.payment_date'
        )
        ->get();

        //dd($bookingDetails->toArray());
        return view('profile.myBookings', compact('bookingDetails'));
    }




}
