<!DOCTYPE html>
<html>
<head>
    <title>Profile Settings</title>
    <style>
        body{
            padding: 0rem 1rem;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;

        }

        div{
            margin-bottom: 1rem;
            
        }

        div>h2{
            font-style: italic;
        }

        form{
            border: 1px solid grey;
            border-radius: 15px;
            padding: 30px;
            width:27%;
        }

        a{
           text-decoration: none; 
        }

        button{
            padding: 8px 13px;
            border-radius: 10px;
            background-color: #4489ba;
            border: 1px solid #4489ba;
            color: white; 
        }

        .home-btn{
            margin-right: 1rem;
        }
    </style>
</head>
<body>
{{-- <h>Profile Settings</h> --}}
<div>
    <h2>Change Profile Details</h2>

    @if (session('status') === 'profile-updated')
    <p style="color: green;">Profile updated successfully!</p>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"><br><br>
        @error('name') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"><br><br>
        @error('email') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Contact:</label>
        <input type="text" name="contact" value="{{ old('contact', $user->contact) }}"><br><br>
        @error('contact') <span style="color:red;">{{ $message }}</span><br> @enderror

        <button type="submit">Update Profile</button>
    </form>
</div>


<div>
    <h2>Change Password</h2>

    @if (session('status') === 'password-updated')
        <p style="color: green;">Password changed successfully!</p>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <label>Current Password:</label>
        <input type="password" name="current_password"><br><br>
        @error('current_password') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>New Password:</label>
        <input type="password" name="password"><br><br>
        @error('password') <span style="color:red;">{{ $message }}</span><br> @enderror

        <label>Confirm New Password:</label>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Change Password</button>
    </form>
</div>


<div>
    <h2>Delete Account</h2>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <label for="password">Current Password:</label>
        <input type="password" name="password"><br><br> 
        @error('userDeletion.password') <span style="color:red;">{{ $message }}</span><br>@enderror

        <button type="submit" onclick="return confirm('Are you sure?');">Delete Account</button>
    </form>
</div>


<div>
    <a href="{{ route('home') }}">
        <button class="home-btn">Go to Home</button>
    </a>

    <a href="{{ route('myBookings') }}">
        <button>Check Booking</button>
    </a>
</div>

</body>
</html>
