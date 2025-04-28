<aside>
    <div class="logo-div">
        <img src="/Image/logo.png" alt="Logo">
    </div>

    {{-- yeh bata dashboard,pages... haru lo limk start hunxa --}}
    <nav class="nav-links">
        <div class="link">
            <a href="{{ route('admin.dashboard') }}" style="font-weight: bold;">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </div>
        
{{-- Pages haru--}}
        <div class="nav-link">
            <h4>PAGES</h4>

            {{-- <div class="link">
                <a href="{{ route('package.index') }}"> 
                    <i class="fa-solid fa-umbrella-beach"></i> </i> Package
                </a>
            </div>

            <div class="link">
                <a href="{{ route('packageBookingList.index') }}"> 
                    <i class="fa-solid fa-folder"></i> Package Booking List
                </a>
            </div>

            
            <div class="link">
                <a href="{{ route('flightBookingList.index') }}"> 
                    <i class="fa-solid fa-plane-departure"></i> Flight Booking List
                </a>
            </div> --}}

            <div class="link {{ request()->routeIs('package.index') ? 'active-link' : '' }}">
                <a href="{{ route('package.index') }}">
                    <i class="fa-solid fa-umbrella-beach"></i> Package
                </a>
            </div>
            
            <div class="link {{ request()->routeIs('packageBookingList.index') ? 'active-link' : '' }}">
                <a href="{{ route('packageBookingList.index') }}">
                    <i class="fa-solid fa-folder"></i> Package Booking List
                </a>
            </div>
            
            <div class="link {{ request()->routeIs('flightBookingList.index') ? 'active-link' : '' }}">
                <a href="{{ route('flightBookingList.index') }}">
                    <i class="fa-solid fa-plane-departure"></i> Flight Booking List
                </a>
            </div>
            
        </div>

{{-- other content haru  --}}
        <div class="nav-link">
            <h4>OTHER</h4>
            <div class="link {{ request()->routeIs('ShowRegisterUsers') ? 'active-link' : '' }}">
                <a href="{{ route('ShowRegisterUsers') }}"> 
                    <i class="fa-solid fa-user"></i> Registered Users
                </a>
            </div>
            

            <div class="link">
                <a href=""> 
                    <i class="fa-solid fa-gear"></i> Setting
                </a>
            </div>

            <div class="link">
                <a href=""> 
                    <i class="fa-solid fa-right-to-bracket"></i> Log Out
                </a>
            </div>

        </div>
       
       

    </nav>
</aside>


    