<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;  
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * This method handles the registration form submission.
     * Request $request: The Request object contains all the data submitted through the registration form.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact' => ['required', 'digits:10'],
            // 'contact' => ['required', 'string', 'max:10'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact, 
        ]);
    
        event(new Registered($user));
    
        // Logs the newly registered user in immediately after successful registration.
        Auth::login($user);
    
        return redirect()->route('home')->with('success', 'Registration successful!');
        // return redirect('/');
    }
    
}



// During user registration, the RegisteredUserController is responsible for managing the password and password_confirmation fields.
// It validates that these two fields match using the confirmed rule, which ensures that the user enters a matching confirmation password.
//  If the validation passes, the password is hashed and stored in the database.


// Rules\Password::defaults(): This is a more complex validation rule provided by Laravel, 
// which includes a set of default rules for passwords, such as ensuring the password is of sufficient length and contains a mix of characters 
// (uppercase, lowercase, numbers, symbols). It's a built-in rule set for handling password complexity.