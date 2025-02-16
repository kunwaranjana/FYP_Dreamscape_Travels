@extends('layouts.main')

@section('container')
 

<div class="package">
    
    <div class="filter-bar">
        <select id="destination">
            <option value="">Sort by Destination</option>
            <option value="fewa-lake">Fewa Lake</option>
            <option value="pashupati">Pashupati Temple</option>
            <option value="trekking">Trekking</option>
        </select>
        <select id="pricing">
            <option value="">Sort by Pricing</option>
            <option value="low-to-high">Low to High</option>
            <option value="high-to-low">High to Low</option>
        </select>
        <select id="duration">
            <option value="">Sort by Duration</option>
            <option value="short">Short (1-3 days)</option>
            <option value="medium">Medium (4-7 days)</option>
            <option value="long">Long (8+ days)</option>
        </select>
    </div>


    <!-- <h3>Book your next destination</h3> -->
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



@endsection