<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class PageController extends Controller
{
    public function jobOpportunities(): View
    {
        $jobs = Job::latest()->get();

        // Get the IDs of jobs the current user has applied for
        $appliedJobIds = [];
        if (Auth::check()) {
            $appliedJobIds = \App\Models\JobApplication::where('user_id', Auth::id())
                                                    ->pluck('job_id')
                                                    ->all();
        }

        return view('jobs', [
            'jobs' => $jobs,
            'appliedJobIds' => $appliedJobIds,
        ]);
    }
    public function viewProfile(): View
    {
            // Get the currently logged-in user
        $user = Auth::user();

        // Pass the user object to the view
        return view('profile.view', ['user' => $user]);
    }

    public function editProfile(): View
    {
        return view('profile.edit', [
            'user' => request()->user(),
        ]);
    }
    
    public function myApplications()
    {
        $applications = \App\Models\JobApplication::where('user_id', Auth::id())
                                                    ->with('job') // Eager load the job details
                                                    ->latest()
                                                    ->get();

        return view('my-applications', compact('applications'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        // If the user is HR
        if ($user->role === 'hr') {
            $totalJobs = \App\Models\Job::count();
            $totalApplications = \App\Models\JobApplication::count();
            $totalUsers = \App\Models\User::where('role', 'user')->count();

            return view('dashboard', compact('totalJobs', 'totalApplications', 'totalUsers'));
        }

        // If the user is a regular user
        $appliedCount = \App\Models\JobApplication::where('user_id', $user->id)->count();
        $totalJobsAvailable = \App\Models\Job::count();
        // For "Active Applications", we'll just use the applied count for now.
        // This could be expanded later to track application status (e.g., 'under review').

        return view('dashboard', compact('appliedCount', 'totalJobsAvailable'));
    }
    public function showJob(\App\Models\Job $job)
    {
        return view('job-show', compact('job'));
    }
}