@extends('layouts.main')

@section('container')
 

<div class="description-container">
    <div class="image-section">
        <h1>Package Title</h1>

        <img src="\Image\pashupati.jpg" alt="Package Image"> 

        <div class="details">
            <div class="one"> <p><span>Destination: </span>Nepal </p></div>
            <div class="two"> <p><span>Days: </span> 1</p></div>
            <div class="three"> <p><span>Price: </span> 1500</p></div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="description-section">
        <h2>Description</h2>
        <div class="note">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod, justo quis fermentum eleifend, odio nisl accumsan arcu, sed tincidunt lorem ligula a quam. Quisque tincidunt malesuada enim.</p>
        </div> 
        <a href="#" class="book-btn">Book Now</a>
    </div>
</div>


@endsection
