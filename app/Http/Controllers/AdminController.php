<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\PackagePayment;
use App\Models\FlightBooking;
use App\Models\FlightPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $from = $request->input('from') ? Carbon::parse($request->input('from')) : Carbon::now()->startOfMonth();
        $to = $request->input('to') ? Carbon::parse($request->input('to')) : Carbon::now();
    
        $packageRevenue = PackagePayment::sum('amount'); //SELECT SUM(amount) FROM payments;
        $flightRevenue = FlightPayment::sum('amount'); //SELECT SUM(amount) FROM flight_payments;
    
        $packageDailyEarnings = PackagePayment::whereDate('payment_date', Carbon::today())->sum('amount');
        $flightDailyEarnings = FlightPayment::whereDate('created_at', Carbon::today())->sum('amount'); 
    
        $packageFilteredRevenue = PackagePayment::whereBetween('payment_date', [$from, $to])->sum('amount');
        $flightFilteredRevenue = FlightPayment::whereBetween('payment_date', [$from, $to])->sum('amount');
    
        $data = [
            'totalPackages' => Package::count(),
            'totalPackageBookings' => PackageBooking::count(),
            'totalFlightBookings' => FlightBooking::count(),

            'totalRevenue' => $packageRevenue + $flightRevenue,
    
            'dailyEarnings' => $packageDailyEarnings + $flightDailyEarnings,
    
            'filteredRevenue' => $packageFilteredRevenue + $flightFilteredRevenue,
    
    
            'from' => $from->format('Y-m-d'),
            'to' => $to->format('Y-m-d'),
        ];
    
        return view('admin.dashboard', compact('data'));
    }




    public function ShowRegisterUsers()
    {
        $users = User::paginate(5);  //SELECT * FROM users LIMIT 5 OFFSET 0;
        
        // $totalUsers = $users->count();
        $totalUsers = User::count(); // SELECT COUNT(*) AS totalUsers FROM users;
        return view('admin.ShowRegisterUsers', compact('users', 'totalUsers'));
    }

}
