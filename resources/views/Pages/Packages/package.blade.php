@extends('layouts.main')

 @section('container')

 
<section class="package-page">
    <div>
        <form method="GET" action="{{ route('user-package.index') }}">
            <div class="filter-bar">
                <select name="destination" onchange="this.form.submit()">
                    <option value="">Filter by destination</option>
                    {{-- $destination variable ma xai database bata destination fetch gareko array ma rakhexa...$dest vaneko xai auta value--}}
                    @foreach ($destinations as $dest) 
                        <option value="{{ $dest }}" {{ request('destination') == $dest ? 'selected' : '' }}>{{ $dest }}</option>
                    @endforeach
                </select>

                <select name="pricing" onchange="this.form.submit()">
                    <option value="">Sort by pricing</option>
                    <option value="low-to-high" {{ request('pricing') == 'low-to-high' ? 'selected' : '' }}>Low to High</option>
                    <option value="high-to-low" {{ request('pricing') == 'high-to-low' ? 'selected' : '' }}>High to Low</option>
                </select>

                <select name="duration" onchange="this.form.submit()">
                    <option value="">Filter by duration</option>
                    <option value="short" {{ request('duration') == 'short' ? 'selected' : '' }}>Short (1-3 days)</option>
                    <option value="medium" {{ request('duration') == 'medium' ? 'selected' : '' }}>Medium (4-7 days)</option>
                    <option value="long" {{ request('duration') == 'long' ? 'selected' : '' }}>Long (8+ days)</option>
                </select>
            </div>
        </form> 
    </div> 


    <div>
        @if ($packages->isEmpty())
            <p style="padding:4rem; text-align: center; font-size: 18px; color: red; height: 360px; background-color:white;">Package Not Available</p>
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
                                <p class="p4">Rs: {{ $package->price }}&nbsp;&nbsp;<span>Per person </span></p>
                            </div>
                        </div>
                    </a>
                </div> 
                @endforeach
            </div>
        @endif
    </div>
   
</section>

@endsection