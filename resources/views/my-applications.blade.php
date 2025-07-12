@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">My Applications</h3>

    <div class="mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Job Title</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Location</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date Applied</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($applications as $application)
                        <tr class="border-b">
                            <td class="w-1/2 text-left py-3 px-4">{{ $application->job->title }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $application->job->location }}</td>
                            <td class="text-left py-3 px-4">{{ $application->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">You have not applied for any jobs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection