@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Applicants for "{{ $job->title }}"</h3>

    <div class="mt-4">
        <a href="{{ route('hr.jobs.index') }}" class="text-indigo-600 hover:text-indigo-900">
            &larr; Back to All Jobs
        </a>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Applicant Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Applicant Email</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date Applied</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($job->applications as $application)
                        <tr class="border-b">
                            <td class="w-1/3 text-left py-3 px-4">{{ $application->user->name }}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{ $application->user->email }}</td>
                            <td class="text-left py-3 px-4">{{ $application->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No one has applied for this job yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection