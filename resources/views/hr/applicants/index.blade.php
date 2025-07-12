@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Jobs with Active Applicants</h3>

    <div class="mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Job Title</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Location</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Applicants</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($jobs as $job)
                        <tr class="border-b">
                            <td class="w-1/2 text-left py-3 px-4">{{ $job->title }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $job->location }}</td>
                            <td class="text-left py-3 px-4">{{ $job->applications_count }}</td>
                            <td class="text-left py-3 px-4">
                                <a href="{{ route('hr.jobs.applications', $job) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded-full hover:bg-indigo-700">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No jobs have any applicants yet.</td>
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