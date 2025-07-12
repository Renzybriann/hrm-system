@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Manage Jobs</h3>

    <div class="mt-4">
        <div class="flex justify-end">
            <a href="{{ route('hr.jobs.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                Create New Job
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Location</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Type</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Applicants</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($jobs as $job)
                        <tr class="border-b">
                            <td class="w-1/4 text-left py-3 px-4">{{ $job->title }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $job->location }}</td>
                            <td class="text-left py-3 px-4">{{ $job->type }}</td>
                            <td class="text-left py-3 px-4">
                                <a href="{{ route('hr.jobs.applications', $job) }}" class="text-indigo-600 hover:text-indigo-900">
                                    View ({{ $job->applications()->count() }})
                                </a>
                            </td>
                            <td class="text-left py-3 px-4">
                                <a href="{{ route('hr.jobs.edit', $job) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('hr.jobs.destroy', $job) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No jobs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection