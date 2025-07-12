<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users, ordered by the most recently created
        $users = User::latest()->paginate(15);

        // Return the view and pass the users data to it
        return view('hr.users.index', compact('users'));
    }
    public function verifyList()
    {
        // Fetch only users that are not yet verified and are not HR admins
        $unverifiedUsers = User::whereNull('email_verified_at')
                                ->where('role', '!=', 'hr')
                                ->latest()
                                ->paginate(15);

        return view('hr.users.verify', compact('unverifiedUsers'));
    }

    public function verifyUser(User $user)
    {
        // Mark the user as verified by setting the current timestamp
        $user->email_verified_at = now();
        $user->save();

        return back()->with('success', 'User has been successfully verified.');
    }
}