@extends('layouts.app')
@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Job Opportunities</h3>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="mt-8">
        {{-- CORRECTED: Using Flexbox for a robust vertical layout --}}
        <div class="flex flex-col gap-6">
            @forelse ($jobs as $job)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h4 class="text-xl font-semibold text-indigo-600">{{ $job->title }}</h4>
                    <p class="text-gray-600 mt-2">{{ $job->description }}</p>
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ $job->location }}</span>
                            <span class="mx-2 text-gray-300">|</span>
                            <span class="text-sm font-medium text-gray-500">{{ $job->type }}</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('jobs.show', $job) }}" class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-100 rounded-md hover:bg-indigo-200">
                                View Details
                            </a>
                            @if(in_array($job->id, $appliedJobIds))
                                <button disabled class="px-4 py-2 text-sm font-medium text-white bg-gray-400 rounded-md cursor-not-allowed">
                                    Applied
                                </button>
                            @else
                                <form action="{{ route('jobs.apply', $job) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500">
                                        Apply Now
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <p class="text-gray-500">No job opportunities available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection