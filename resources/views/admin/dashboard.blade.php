@extends('admin.inc.main')

@section('container')

<style>
    .dashboard-title {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin: 30px 0 20px 0;
        text-align: center;
    }

    .dashboard-section {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a5f;
        margin-bottom: 25px;
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 25px;
    }

    .card {
        background: #f4f8fb;
        border-left: 5px solid #4489ba;
        padding: 25px;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        background-color: #eaf4fa;
    }

    .card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-align: left;
    }

    .filter-form {
        margin-bottom: 30px;
    }

    .filter-form label {
        font-weight: 500;
    }

    .section-title i {
        color: #4489ba;
        font-size: 20px;
    }
</style>

<h2 class="dashboard-title">Admin Dashboard Overview</h2>

{{-- BOOKING SECTION --}}
<div class="dashboard-section">
    <h4 class="section-title"><i class="fa-solid fa-boxes-packing"></i> Booking Information</h4>
    <div class="dashboard-grid">
        <div class="card">
            <h3><i class="fa-solid fa-umbrella-beach"></i> Total Packages</h3>
            <p>{{ $data['totalPackages'] }}</p>
        </div>

        <div class="card">
            <h3><i class="fa-solid fa-list-check"></i> Package Bookings</h3>
            <p>{{ $data['totalPackageBookings'] }}</p>
        </div>

        <div class="card">
            <h3><i class="fa-solid fa-plane-departure"></i> Flight Bookings</h3>
            <p>{{ $data['totalFlightBookings'] }}</p>
        </div>
    </div>
</div>

{{-- PAYMENT SECTION --}}
<div class="dashboard-section">
    <h4 class="section-title"><i class="fa-solid fa-money-bill-wave"></i> Payment Overview</h4>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-form d-flex gap-3 flex-wrap align-items-end">
        <div>
            <label for="from">From:</label>
            <input type="date" name="from" id="from" class="form-control" value="{{ request('from', $data['from']) }}">
        </div>

        <div>
            <label for="to">To:</label>
            <input type="date" name="to" id="to" class="form-control" value="{{ request('to', $data['to']) }}">
        </div>

        <div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filter</button>
        </div>
    </form>

    <div class="dashboard-grid">
        <div class="card">
            <h3><i class="fa-solid fa-coins"></i> Today's Earnings</h3>
            <p>Rs {{ $data['dailyEarnings'] }}</p>
        </div>

        <div class="card">
            <h3><i class="fa-solid fa-wallet"></i> Total Revenue</h3>
            <p>Rs {{ $data['totalRevenue'] }}</p>
        </div>

        <div class="card">
            <h3><i class="fa-solid fa-chart-line"></i> Filtered Revenue</h3>
            <p>Rs {{ $data['filteredRevenue'] }}</p>
        </div>
    </div>
</div>
@endsection
