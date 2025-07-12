@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Edit Job</h3>

    <div class="mt-8">
        {{-- Add enctype for file uploads --}}
        <form action="{{ route('hr.jobs.update', $job) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Location -->
                <div class="mt-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Job Type -->
                <div class="mt-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Job Type (e.g., Full-time, Part-time)</label>
                    <input type="text" name="type" id="type" value="{{ old('type', $job->type) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $job->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- PDF Upload -->
                <div class="mt-4">
                    <label for="pdf_path" class="block text-sm font-medium text-gray-700">Job Details (PDF)</label>
                    @if ($job->pdf_path)
                        <div class="mt-2 text-sm">
                            Current file: <a href="{{ Storage::url($job->pdf_path) }}" target="_blank" class="text-indigo-600 hover:underline">View PDF</a>
                        </div>
                    @endif
                    <input type="file" name="pdf_path" id="pdf_path" class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current file.</p>
                    @error('pdf_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>


                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('hr.jobs.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-300">Cancel</a>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Update Job</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection