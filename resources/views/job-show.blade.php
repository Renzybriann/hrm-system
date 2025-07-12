@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('jobs') }}" class="text-indigo-600 hover:text-indigo-900">
            &larr; Back to All Opportunities
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Job Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $job->title }}</h3>
                <div class="flex items-center text-gray-500 mt-2">
                    <span>{{ $job->location }}</span>
                    <span class="mx-2 text-gray-300">|</span>
                    <span>{{ $job->type }}</span>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                {{-- We can reuse the same logic for the apply button here --}}
                @if(in_array($job->id, (Auth::user()->jobApplications->pluck('job_id')->all() ?? [])))
                    <button disabled class="w-full px-6 py-3 text-lg font-medium text-white bg-gray-400 rounded-lg cursor-not-allowed">
                        Applied
                    </button>
                @else
                    <form action="{{ route('jobs.apply', $job) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 text-lg font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            Apply Now
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Job Description -->
        <div class="mt-6 border-t border-gray-200 pt-6">
            <h4 class="text-xl font-semibold text-gray-700">Job Description</h4>
            <p class="mt-2 text-gray-600 whitespace-pre-wrap">{{ $job->description }}</p>
        </div>

        <!-- PDF Preview -->
        @if($job->pdf_url)
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h4 class="text-xl font-semibold text-gray-700">Job Details Document</h4>
                <div class="mt-4">
                    <iframe src="{{ $job->pdf_url }}" width="100%" height="600px" style="border: none;">
                        Your browser does not support PDFs. <a href="{{ $job->pdf_url }}">Download the PDF</a> instead.
                    </iframe>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection