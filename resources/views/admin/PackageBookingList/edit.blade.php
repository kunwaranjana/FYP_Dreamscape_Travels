@extends('admin.inc.main')

@section('container')

<h2>Edit Booking</h2>

<form action="{{ route('packageBookingList.update', $booking->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Traveler Name</label>
    <input type="text" name="name" value="{{ $booking->name }}" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="{{ $booking->email }}" required>

    <label for="contact">Contact</label>
    <input type="text" name="contact" value="{{ $booking->contact }}" required>

    <label for="travelerCount">Traveler Count</label>
    <input type="number" name="travelerCount" value="{{ $booking->travelerCount }}" required>

    <label for="amount">total Amount</label>
    <input type="number" name="amount" value="{{ $booking->amount }}" required>

    <button type="submit">Update Booking</button>
</form>

@endsection
