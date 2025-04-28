@extends('layouts.main')

@section('container')
 

<div class="description-container">
    <div class="image-section">
        <h1>{{ $package->title }}</h1>
        <img src="{{ asset('uploads/' . $package->img) }}" alt="{{ $package->title }}" >
    </div>

    <!-- Description Section -->
    <div class="description-section">
        <h2>Description</h2>

        <div class="description">
            <div class="details">
                <div class="one"> Destination: <span> {{ $package->destination }}</span>  </div>
                <div class="two"> Days: <span> {{ $package->duration }} </span></div>
                <div class="three"> Price: Rs<span>{{ $package->price }}</span>  </div>
            </div>

            <div class="note">
                {{-- <p>{{ $package->description }} </p> --}}
                <p>{!! nl2br(e($package->description)) !!}</p>

            </div> 
    
           <div class="book-btn-div">
            <a href="{{ route('user-package.showBookingForm', ['id' => $package->id]) }}" class="book-btn">Book Now</a>
           </div>
        </div>


    </div>
</div>


@endsection
