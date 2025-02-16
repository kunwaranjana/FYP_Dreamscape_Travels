<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In Form</title>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url('/Image/mountain.jpeg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }


        .form-container {
            background: rgba(255, 255, 255, 0.2); 
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #fff;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container form .field {
            margin-bottom: 16px;
        }

        .form-container form .field label {
            color: rgb(71, 70, 70);
            /* color: #fff; */
            font-size: 17px;

        }

        .form-container form .field input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid;
            border-radius: 5px;
            font-size: 14px; 
            background: rgba(255, 255, 255, 0.2);           
        }

        .form-container form .field input[type="submit"] {
            background: #007bff;
            border: 1px solid #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-container form .field input[type="submit"]:hover {
            background: #0056b3;
        }

        hr {
            margin: 16px 0;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }


        .form-container form .login-div {
            text-align: center;
            margin-top: 8px;
        }

        .form-container form .login-div p {
            display: inline;
            font-size: 15px;
            color: #fff;
        }

        .form-container form .login-div a {
            font-size: 15px;
            color: #0056b3;
            font-weight: bold;
            /* text-decoration: none; */
            margin-left: 5px;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
         }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Welcome to Dreamscape</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"  placeholder="Enter your full name" >
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"  value="{{ old('email') }}"  placeholder="Enter your email" >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"  placeholder="Enter your password" >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"placeholder="Confirm your password" >
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact"  value="{{ old('contact') }}" placeholder="Enter your contact number" >
                @error('contact')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="field">
                <input type="submit" value="Sign In">
            </div>

            <hr>
            <div class="login-div">
                <p>Already have account?</p><a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
</body>
</html>



{{-- The @error and @enderror directives are:Laravel Blade features. --}}
 