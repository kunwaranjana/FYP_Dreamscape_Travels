<?php
use App\Http\Controllers\pdfGenerateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AdminFlightController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PaymentController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', function () {
    return view('register');})->name('register');

Route::get('/login', function () {
    return view('login');})->name('login');

//HOME PAGE
Route::get('/', function () {
    return view('pages.home');})->name('home');

Route::get('/about', function () {
    return view('pages.about');})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
    



//It creates a GET request route for the URL written. When a user visits /packages, Laravel calls the index method of PackageController.
//The route is named package for easy reference using route('package').
Route::get('/user-package', [PackageController::class, 'index'])->name('user-package.index');
Route::get('/user-package/{id}', [PackageController::class, 'showPackageDescription'])->name('user-package.showPackageDescription');

Route::post('/flights/search', [FlightController::class, 'search'])->name('flights.search');

Route::middleware('auth')->group(function () {
    Route::get('/user-package/{id}/booking', [PackageBookingController::class, 'showBookingForm'])->name('user-package.showBookingForm');
    Route::post('/packageBooking/storeFirst/{id}', [PackageBookingController::class, 'storeFirstForm'])->name('packageBooking.storeFirstForm');
    Route::get('/packageBooking/secondForm/{id}', [PackageBookingController::class, 'showSecondForm'])->name('packageBooking.showSecondForm');
    Route::post('/packageBooking/storeSecond/{id}', [PackageBookingController::class, 'storeSecondForm'])->name('packageBooking.storeSecondForm');
    
    Route::get('package/payment/{booking_id}', [PaymentController::class, 'pay'])->name('package.payment');
    Route::get('esewa/check/', [PaymentController::class, 'check'])->name('esewa.check');

    Route::get('/payment-success', function () {
        return view('payment.success');
    })->name('payment.success');
    
    Route::get('/payment-failed', function () { 
        return view('payment.failed');
    })->name('payment.failed');

    Route::get('/download-payment-receipt/{id}', [pdfGenerateController::class, 'downloadPaymentReceipt'])->name('paymentReceipt.downloadPDF');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/my-bookings', [ProfileController::class, 'myBookings'])->name('myBookings');

    // Route::post('/flights/passenger-form', [FlightController::class, 'showPassengerForm'])->name('flights.passenger-form');
    // Route::post('/flights/confirm-booking', [FlightController::class, 'confirmBooking'])->name('flights.confirm-booking');
    // Route::get('/booking/download-pdf/{id}', [pdfGenerateController::class, 'downloadFlightBookingPDF'])->name('booking.downloadPDF');
    // Route::get('/download-payment-receipt/{id}', [pdfGenerateController::class, 'downloadPaymentReceipt'])->name('paymentReceipt.downloadPDF');
    // Route::post('/flight/payment/process', [FlightController::class, 'processPayment'])->name('flight.payment.process');


    
    Route::post('/flights/passenger-form', [FlightController::class, 'showPassengerForm'])->name('flights.passenger-form');    
    Route::get('/flights/payment-form/{id}', [FlightController::class, 'showPaymentForm'])->name('flight.showPaymentForm');
    Route::post('/flight/payment/process', [FlightController::class, 'processPayment'])->name('flight.processPayment');
    Route::post('/flights/confirm-booking', [FlightController::class, 'confirmBooking'])->name('flights.confirm-booking');
    Route::get('/booking/download-pdf/{id}', [pdfGenerateController::class, 'downloadFlightBookingPDF'])->name('booking.downloadPDF');
   
});



// for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
   Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');   
    Route::resource('admin/package', AdminPackageController::class);
    //Note: Laravel assigns these route names by default when you define a resource route.{resourceName}.{action}

    Route::get('/admin/packageBookingList', [PackageBookingController::class, 'index'])->name('packageBookingList.index');
    // Route::get('/admin/packageBookings/{id}', [PackageBookingController::class, 'edit'])->name('packageBookingList.edit');
    // Route::put('/admin/packageBookings/{id}', [PackageBookingController::class, 'update'])->name('packageBookingList.update');
    // Route::delete('/admin/packageBookings/{id}', [PackageBookingController::class, 'destroy'])->name('packageBookingList.destroy');

    Route::get('/admin/flightBookingList', [AdminFlightController::class, 'index'])->name('flightBookingList.index');
    Route::get('/admin/flightBookingList/passenger/edit/{id}', [AdminFlightController::class, 'editPassenger'])->name('passenger.edit');
    Route::put('/admin/flightBookingList/passenger/update/{id}', [AdminFlightController::class, 'updatePassenger'])->name('passenger.update');
    Route::delete('/flight-booking/{id}', [AdminFlightController::class, 'deleteFlightBooking'])->name('flightBooking.delete');


    Route::get('/admin/RegisterUserList', [AdminController::class, 'ShowRegisterUsers'])->name('ShowRegisterUsers');
   
});



require __DIR__.'/auth.php';
