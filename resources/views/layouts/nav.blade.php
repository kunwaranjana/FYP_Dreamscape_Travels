<nav> 
    <div class="logo">
        <img src="/Image/logo.png" alt="Logo" height="62cm" width="150cm">
    </div>

        <div class="links">
        <a href="/packageDescription">Home</a>
        <a href="">Flights</a>
        <a href="/package">Packages</a>
        <a href="/about">About Us</a>
        </div>

        <div class="signup-login">
            {{-- Show "Sign up" and "Login" for guests --}}
            @guest
                <a href="{{ route('register') }}" class="signup">Sign up</a>
                <a href="{{ route('login') }}" class="login">Login</a>
            @endguest
    
            {{-- Show "Profile" and "Logout" for authenticated users --}}
            @auth
                <a href="{{ route('profile.edit') }}" class="profile">Profile</a>
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf
                    <button type="submit" class="logout">Logout</button>
                </form>
            @endauth

        </div>
</nav>





