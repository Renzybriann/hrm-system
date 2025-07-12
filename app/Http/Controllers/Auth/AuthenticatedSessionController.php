<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
        {
            // 1. Validate the incoming data, including the new 'role' field
            $credentials = $request->validate([
                'role' => ['required', 'string', 'in:user,hr'],
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            // 2. Attempt to authenticate the user with email and password only
            if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
                return back()->withErrors([
                    'email' => __('auth.failed'),
                ])->onlyInput('email', 'role');
            }

            // 3. Authentication passed, now get the user and check their role
            $user = Auth::user();
            $selectedRole = $credentials['role'];

            if ($user->role !== $selectedRole) {
                // If roles don't match, log them out and send back an error
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'The selected role does not match this account.',
                ])->onlyInput('email', 'role');
            }

            // 4. Everything is correct, regenerate the session
            $request->session()->regenerate();

            // 5. Redirect all authenticated users to the main dashboard
            return redirect()->intended(route('dashboard', absolute: false));
}

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
