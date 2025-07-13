@extends('layouts.app')

@section('content')

{{-- =================================================================== --}}
{{-- ======================= HR DASHBOARD VIEW ========================= --}}
{{-- =================================================================== --}}
@if(Auth::user()->role === 'hr')

<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">HR Dashboard</h3>

    <!-- HR Statistics Cards -->
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    <div class="h-16 w-16 rounded-full bg-opacity-75 flex items-center justify-center">
                        <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//briefcase.png" alt="Briefcase Icon" class="h-16 w-16">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700">{{ $totalJobs }}</h4>
                        <div class="text-gray-500">Total Job Postings</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    <div class="h-16 w-16 rounded-full bg-opacity-75 flex items-center justify-center">
                        <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//inbox.png" alt="Briefcase Icon" class="h-16 w-16">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700">{{ $totalApplications }}</h4>
                        <div class="text-gray-500">Total Applications</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    <div class="h-16 w-16 rounded-full bg-opacity-75 flex items-center justify-center">
                        <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//ruser.png" alt="Briefcase Icon" class="h-14 w-14">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700">{{ $totalUsers }}</h4>
                        <div class="text-gray-500">Registered Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <h4 class="text-xl font-medium text-gray-700">Quick Actions</h4>
        <div class="mt-4 flex flex-wrap gap-4">
            <a href="{{ route('hr.jobs.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i>Post a New Job
            </a>
            <a href="{{ route('hr.applicants.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-user-friends mr-2"></i>Review Applicants
            </a>
        </div>
    </div>
</div>

@endif
{{-- =================================================================== --}}
{{-- ===================== USER DASHBOARD VIEW ======================= --}}
{{-- =================================================================== --}}
@if(Auth::user()->role === 'user')

<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Welcome, {{ Auth::user()->name }}!</h3>

    <!-- User Status Cards -->
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <!-- Verification Status -->
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    
                    <!-- The Icon Container -->
                    <div class="h-16 w-16 rounded-full {{ Auth::user()->hasVerifiedEmail() ? 'bg' : 'bg' }} bg-opacity-75 flex items-center justify-center">
                        @if (Auth::user()->hasVerifiedEmail())
                            {{-- Show the 'verified' icon --}}
                            <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//verified.png" alt="Verified Icon" class="h-16 w-16">
                        @else
                            {{-- Show the 'not-verified' icon --}}
                            <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//not-verified.png" alt="Not Verified Icon" class="h-10 w-10">
                        @endif
                    </div>

                    <div class="mx-5">
                        <h4 class="text-xl font-semibold text-gray-700">
                            {{ Auth::user()->hasVerifiedEmail() ? 'Verified' : 'Not Verified' }}
                        </h4>
                        <div class="text-gray-500">Account Status</div>
                    </div>
                </div>
            </div>

            <!-- Applied Positions -->
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    <div class="h-16 w-16 rounded-full bg-opacity-75 flex items-center justify-center">
                        <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//position.png" alt="Briefcase Icon" class="h-16 w-16">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700">{{ $appliedCount }}</h4>
                        <div class="text-gray-500">Applied Positions</div>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-lg shadow-md">
                    <div class="h-16 w-16 rounded-full bg-opacity-75 flex items-center justify-center">
                        <img src="https://osbozdkotesdrlrwuxwa.supabase.co/storage/v1/object/public/icons//job.png" alt="Briefcase Icon" class="h-16 w-16">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-bold text-gray-700">{{ $totalJobsAvailable }}</h4>
                        <div class="text-gray-500">Job Opportunities</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-8 bg-white shadow-md rounded-lg p-6">
        <h4 class="text-xl font-medium text-gray-800">Ready for your next role?</h4>
        <p class="text-gray-600 mt-2">Explore our open positions and find the perfect fit for your skills and career goals.</p>
        <div class="mt-4">
            <a href="{{ route('jobs') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Browse Job Opportunities
            </a>
        </div>
    </div>
</div>

@endif

@endsection