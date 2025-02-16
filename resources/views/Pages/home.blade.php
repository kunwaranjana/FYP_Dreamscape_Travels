@extends('layouts.main')

@section('container')
 

<div class="home">
    <div class="texts inria-sans-bold-italic">
        <span class="text1">Explore the world With us!</span>
    </div>

    <div class="container">

        <div class="radio-group">
            <input type="radio" name="way" value="one_way" checked onclick="toggleArrival()"> One way
            &nbsp;&nbsp;&nbsp;
            <input type="radio" name="way" value="two_way" onclick="toggleArrival()"> Two way
        </div>
    
        <div class="input-group">
            <label for="from">From:</label>
            <select id="from">
                <option value="">Select</option>
                <option value="New York">New York</option>
                <option value="Los Angeles">Los Angeles</option>
                <option value="Chicago">Chicago</option>
                <option value="London">London</option>
                <option value="Paris">Paris</option>
            </select>
        </div>
    
        <div class="input-group">
            <label for="to">To:</label>
            <select id="to">
                <option value="">Select</option>
                <option value="New York">New York</option>
                <option value="Los Angeles">Los Angeles</option>
                <option value="Chicago">Chicago</option>
                <option value="London">London</option>
                <option value="Paris">Paris</option>
            </select>
        </div>
    
        <div class="input-group">
            <label for="depart">Depart:</label>
            <input type="date" id="depart">
        </div>
    
        <div class="input-group" id="arrivalField"> 
            <label for="arrival">Arrival:</label>
            <input type="date" id="arrival"> 
        </div>
    
        <div class="input-group">
            <label for="passengers">Passengers:</label>
            <input type="number" id="passengers" min="1">
        </div>
    
        <button type="button"><a href="">Search</a></button>
    
    </div>
    
    
    <script>
    function toggleArrival() {
        var tripType = document.querySelector('input[name="way"]:checked').value;
        var arrivalField = document.getElementById("arrivalField");
    
        if (tripType === "one_way") {
            arrivalField.classList.add("hidden"); 
            // Remove unnecessary '()' in onclick attribute
        } else {
            arrivalField.classList.remove("hidden"); 
        }
    }
    </script>
</div>

{{-- <img src="{{ asset('assets/img/pexels-clothing.jpg') }}" > --}}

<div class="package">
    <h3>Book your next destination</h3>
    <div class="cards">
        <!-- First Row -->
        <div class="card">
            <img src="/Image/fewa lake.jpg" alt="" height="400px" width="350px">
            <p>Fewa lake Boating</p>
        </div>
        <div class="card">
            <img src="/Image/pashupati.jpg" alt="" height="400px" width="350px">
            <p>Pashupati Temple Visit</p>
        </div>
        <div class="card">
            <img src="/Image/trek.jpg" alt="" height="400px" width="350px">
            <p>Trekking</p>
        </div>
        <!-- Second Row -->
        <div class="card">
          <img src="/Image/fewa lake.jpg" alt="" height="400px" width="350px">
          <p>Fewa lake Boating</p>
      </div>
      <div class="card">
          <img src="/Image/pashupati.jpg" alt="" height="400px" width="350px">
          <p>Pashupati Temple Visit</p>
      </div>
      <div class="card">
          <img src="/Image/trek.jpg" alt="" height="400px" width="350px">
          <p>Trekking</p>
      </div>
    </div>
</div>

<section class="review-section">
    <h1>What Client Says about ?</h1>

    <div class="review">
        <div class="review-card">
            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente tenetur magnam dolores neque dolor odio quam animi deleniti magni earum officiis eaque, rem, est perferendis. Doloremque nobis harum laboriosam similique!</P>
            <h3>username</h3>
        </div>

        <div class="review-card">
            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente tenetur magnam dolores neque dolor odio quam animi deleniti magni earum officiis eaque, rem, est perferendis. Doloremque nobis harum laboriosam similique!</P>
            <h3>username</h3>
        </div>

        <div class="review-card">
            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente tenetur magnam dolores neque dolor odio quam animi deleniti magni earum officiis eaque, rem, est perferendis. Doloremque nobis harum laboriosam similique!</P>
            <h3>username</h3>
        </div>

    </div>
</section>


  @endsection