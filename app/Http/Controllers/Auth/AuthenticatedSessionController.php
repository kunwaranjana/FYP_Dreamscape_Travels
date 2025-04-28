<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /** CODE1
     * Handle an incoming authentication request.
// //      */
//     public function store(LoginRequest $request): RedirectResponse
//     {
//         $request->authenticate();

//         $request->session()->regenerate();


//         $url = "/";

//         if ($request->user()->role == "admin") {
//             $url = "/admin";
//         }

//         return redirect($url);
// }

    //CODE 2
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (! $user) {
    //         throw ValidationException::withMessages([
    //             'email' => 'This email is not registered.',
    //         ]);
    //     }

    //     if (! Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'password' => 'Incorrect password.',
    //         ]);
    //     }

    //     Auth::login($user);
    //     $request->session()->regenerate();
    
    //     if ($user->role === 'admin') {
    //         return redirect('/admin');
    //     }
    
    //     return redirect()->intended('/');
    // }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user) {
            return back()->withErrors([
                'email' => 'This email is not registered.',
            ])->withInput();
        }
    
        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput();
        }
    
        Auth::login($user);
        $request->session()->regenerate();
    
        if ($user->role === 'admin') {
            return redirect('/admin');
        }
    
        return redirect('/');
    }
    

        
        
        // home page ma liyera janxa
        // return redirect()->intended(route('home'))->with('success', 'Login successful!');

        // yo paila bata vako default route ho 
        // return redirect()->intended(route('dashboard', absolute: false));   
    

    /**
     * Destroy an authenticated session.
     */
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
