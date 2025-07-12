@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">Manage Users</h3>

    <div class="mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Role</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Joined</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($users as $user)
                        <tr class="border-b">
                            <td class="w-1/4 text-left py-3 px-4">{{ $user->name }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $user->email }}</td>
                            <td class="text-left py-3 px-4">
                                <span class="capitalize px-2 py-1 text-xs font-semibold rounded-full {{ $user->role === 'hr' ? 'bg-indigo-200 text-indigo-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="text-left py-3 px-4">
                                @if ($user->hasVerifiedEmail())
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                        Not Verified
                                    </span>
                                @endif
                            </td>
                            <td class="text-left py-3 px-4">{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection