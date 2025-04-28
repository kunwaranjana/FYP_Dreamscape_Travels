@extends('layouts.main')

@section('container')
 

<div class="home">
    <div class="texts inria-sans-bold-italic">
        <span class="text1">Explore the world With us!</span>
    </div>

    {{-- flight Search --}}
    <div class="homepage-flightcontainer">

        <div class="custom-alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>

        <form action="{{ route('flights.search') }}" method="POST">
            @csrf
            <div class="radio-group">
                <input type="radio" name="way" value="one_way" checked onclick="toggleArrival()"> One way
                &nbsp;&nbsp;&nbsp;
                <input type="radio" name="way" value="two_way" onclick="toggleArrival()"> Two way
            </div>

            <div class="input-group">
                <label for="from">From:</label>
                <select id="from" name="from_city">
                    <option value="">Select</option>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Bhairahawa">Bhairahawa</option>
                    <option value="New York">New York</option>
                    <option value="Los Angeles">Los Angeles</option>
                    <option value="Chicago">Chicago</option>
                    <option value="London">London</option>
                    <option value="Paris">Paris</option>
                    <option value="Tokyo">Tokyo</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sydney">Sydney</option>
                    <option value="Toronto">Toronto</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Rome">Rome</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Amsterdam">Amsterdam</option>
                    <option value="Bangkok">Bangkok</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Beijing">Beijing</option>
                    <option value="Seoul">Seoul</option>
                </select>
                <input type="hidden" name="origin" id="origin_code">
            </div>

            <div class="input-group">
                <label for="to">To:</label>
                <select id="to" name="to_city">
                    <option value="">Select</option>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Bhairahawa">Bhairahawa</option>
                    <option value="New York">New York</option>
                    <option value="Los Angeles">Los Angeles</option>
                    <option value="Chicago">Chicago</option>
                    <option value="London">London</option>
                    <option value="Paris">Paris</option>
                    <option value="Tokyo">Tokyo</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sydney">Sydney</option>
                    <option value="Toronto">Toronto</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Rome">Rome</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Amsterdam">Amsterdam</option>
                    <option value="Bangkok">Bangkok</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Beijing">Beijing</option>
                    <option value="Seoul">Seoul</option>
                </select>
                <input type="hidden" name="destination" id="destination_code">
            </div>

            <div class="input-group">
                <label for="depart">Depart:</label>
                <input type="date" id="depart" name="departureDate">
            </div>

            <div class="input-group" id="arrivalField">
                <label for="arrival">Arrival:</label>
                <input type="date" id="arrival" name="returnDate">
            </div>

            <div class="input-group">
                <label for="passengers">Passengers:</label>
                <input type="number" id="passengers" name="adults" min="1" value="1">
            </div>

            <button type="submit" class="submit-btn">Search &nbsp; <i class="fas fa-plane"></i>
            </button>
        </form>
    </div>

    <script>
        // function toggleArrival() {
        //     var arrivalField = document.getElementById('arrivalField');
        //     var way = document.querySelector('input[name="way"]:checked').value;
        //     arrivalField.style.display = way === 'two_way' ? 'block' : 'none';
        // }
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

        document.getElementById('from').addEventListener('change', function() {
            var city = this.value;
            var iataCode = getIataCode(city);
            document.getElementById('origin_code').value = iataCode;
        });

        document.getElementById('to').addEventListener('change', function() {
            var city = this.value;
            var iataCode = getIataCode(city);
            document.getElementById('destination_code').value = iataCode;
        });

        function getIataCode(city) {
            switch (city) {
                case 'Kathmandu': return 'KTM';
                case 'Pokhara': return 'PKR';
                case 'Bhairahawa': return 'BWA';
                case 'New York': return 'JFK';
                case 'Los Angeles': return 'LAX';
                case 'Chicago': return 'ORD';
                case 'London': return 'LHR';
                case 'Paris': return 'CDG';
                case 'Tokyo': return 'HND';
                case 'Dubai': return 'DXB';
                case 'Singapore': return 'SIN';
                case 'Sydney': return 'SYD';
                case 'Toronto': return 'YYZ';
                case 'Berlin': return 'BER';
                case 'Rome': return 'FCO';
                case 'Madrid': return 'MAD';
                case 'Amsterdam': return 'AMS';
                case 'Bangkok': return 'BKK';
                case 'Kuala Lumpur': return 'KUL';
                case 'Delhi': return 'DEL';
                case 'Mumbai': return 'BOM';
                case 'Beijing': return 'PEK';
                case 'Seoul': return 'ICN';
                default: return '';
            }
        }

        toggleArrival();
    </script>
</div>


<div class="second-third-part">
    <div class="dream-section">
      <div class="dream-side-img">
        <img src="Image/pexels-iqxazmi-3119806.jpg" alt="Image">
      </div>
  
      <div class="dream-side-text dream-text-box">
        <h1>Dreamscape Travels</h1>
        {{-- <marquee class="dream-marquee" behavior="scroll" direction="left" scrollamount="5">
           Find your next adventure travel beyond boundaries. 
        </marquee> --}}

        <p class="dream-marquee" >Find your next adventure travel beyond boundaries. </p>

        <button class="dream-btn">Get Started</button>
      </div>
    </div>
  
    <!-- Second Section: Text Left | Image Right -->
    <div class="dream-section">
      <div class="dream-side-text dream-text-box">
        <h1>our journey begins here</h1>
        <p style="font-size: 18px; color: #666; max-width: 500px; margin-bottom: 20px;">
          Discover handpicked destinations, curated experiences, and personal touches that turn a trip into a story worth telling.
        </p>
        <button class="dream-btn">Discover More</button>
      </div>
  
      <div class="dream-side-img">
        <img src="Image/pexels-samrat-maharjan-156568-1479825.jpg" alt="Image">
      </div>
    </div>

  </div>


{{-- <div class="package">
    <h1>Book your next destination</h1>
    
    @if ($packages->isEmpty())
        <p style="text-align: center; font-size: 18px; color: red;">No packages found.</p>
    @else
        <div class="cards">
            @foreach ($packages as $package)
            <div class="card">
                <a href="{{ route('user-package.showPackageDescription', $package->id) }}">
                    <img src="{{ asset('uploads/' . $package->img) }}" alt="{{ $package->title }}" height="400px" width="350px">
                    
                    <div class="box">
                        <p class="p1">{{ $package->title }}</p>

                        <div class="pac">
                            <p class="p2"><i class="fa-solid fa-location-dot"></i>&nbsp;{{ $package->destination }}</p>
                            <p class="p3"><span>Day:</span>&nbsp;{{ $package->duration }}</p>
                        </div>

                        <div class="pri">
                            <p class="p4">Rs: {{ $package->price }}&nbsp;<span>Per person</span></p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div> --}}

{{-- static --}}
{{-- <div class="package">
    <h1>Book your next destination</h1>
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
</div> --}}

<section class="review-section">
    <h1>What Client Says about ?</h1>

    <div class="review">
        <div class="review-card">
            <p>Dreamscape Travels made my trip planning so much easier! The website is user-friendly, and I was able to compare flight options effortlessly. The prices were competitive, and the booking process was smooth. Highly recommended!</p>
            <h3>Anushka</h3>
        </div>

        <div class="review-card">
            <p>I had an issue with my booking, but the customer support team was incredibly helpful and resolved it quickly. Their prompt assistance gave me peace of mind. Will definitely book with them again!</p>
            <h3>Sudikshya</h3>
        </div>

        <div class="review-card">
          <p>Dreamscape Travels is my go-to travel booking site. The platform is easy to navigate, and I love the travel themes and preferences options. Whether it's a budget trip or luxury travel, they have something for everyone!</p>
            <h3>Tina Grg</h3>
        </div>

    </div>
</section>

  @endsection