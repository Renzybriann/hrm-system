<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        // Check if the user has already applied for this job
        $existingApplication = JobApplication::where('job_id', $job->id)
                                             ->where('user_id', Auth::id())
                                             ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // Create the application
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'You have successfully applied for the job!');
    }
}