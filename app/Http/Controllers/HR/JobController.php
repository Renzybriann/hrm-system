<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('hr.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr.jobs.create');
    }

    public function store(Request $request)
    {
            $request->validate([
                'title' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'description' => 'required|string',
                'pdf_path' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // Validate the PDF
            ]);

            $data = $request->all();

            // Handle the file upload
            if ($request->hasFile('pdf_path')) {
                $data['pdf_path'] = $request->file('pdf_path')->store('job-details', 'public');
            }

            Job::create($data);

            return redirect()->route('hr.jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        // Not used for this implementation, but good to have.
        return view('hr.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('hr.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'pdf_path' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // Validate the new PDF
        ]);

        $data = $request->all();

        // Handle the file upload if a new file is provided
        if ($request->hasFile('pdf_path')) {
            // 1. Delete the old file if it exists
            if ($job->pdf_path) {
                Storage::disk('public')->delete($job->pdf_path);
            }

            // 2. Store the new file
            $data['pdf_path'] = $request->file('pdf_path')->store('job-details', 'public');
        }

        $job->update($data);

        return redirect()->route('hr.jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('hr.jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function viewApplications(Job $job)
    {
        // Eager load the applications and the user associated with each application
        $job->load('applications.user');

        return view('hr.jobs.applications', compact('job'));
    }

    public function applicantsIndex()
    {
        // Get only jobs that have applications, and also count how many they have.
        $jobs = Job::whereHas('applications')->withCount('applications')->latest()->paginate(15);

        return view('hr.applicants.index', compact('jobs'));
    }
}