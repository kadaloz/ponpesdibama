@extends('layouts.admin')

@section('title', 'Log Audit Trail')
@section('header_admin', 'Audit Trail Sistem')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-4">Riwayat Aktivitas Pengguna</h3>

        @if ($logs->isEmpty())
            <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                Belum ada aktivitas yang tercatat.
            </p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IP</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Browser</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4 text-sm font-medium text-teal-700">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</td>
                                <td class="py-2 px-4 text-sm text-gray-800">{{ $log->description }}</td>
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $log->user_name ?? 'Guest' }}</td>
                                <td class="py-2 px-4 text-sm text-gray-600">{{ $log->ip_address }}</td>
                                <td class="py-2 px-4 text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($log->user_agent, 50) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
