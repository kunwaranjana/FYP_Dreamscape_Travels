<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    {{-- I just found this way of implementing boostrap However after this my own made custom html and css is 
    looking different in some part Looks like boostrap override the css part too   --}}
     {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])   --}}

    {{-- another way to implement however result is same --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>


    <link href="{{ asset('assets/adminDashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="admin-container"> 
        @include('admin.inc.aside')  {{-- Sidebar --}}
        
        <main>
            @include('admin.inc.header') {{-- Navbar --}}
            <div class="content-area">
                @yield('container') {{-- Dynamic Content --}}
            </div>
        </main>
    </div>
</body>
</html>
