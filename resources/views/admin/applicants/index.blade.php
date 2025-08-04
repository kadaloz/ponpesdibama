@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran PSB')

@section('header_admin', 'Manajemen Pendaftaran PSB')

@section('admin_content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pendaftaran PSB</h1>
        <p class="text-gray-500 mt-1">Kelola dan pantau semua data pendaftaran calon santri.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Filter Data Pendaftar</h3>
        <form action="{{ route('admin.applicants.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-grow">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/No.Pendaftaran</label>
                <input type="text" name="search" id="search" placeholder="Cari..." value="{{ request('search') }}"
                       class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
            </div>
            <div class="w-full md:w-auto">
                <label for="entry_year" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                <select name="entry_year" id="entry_year" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                    <option value="">Semua Tahun</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}" {{ request('entry_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-auto">
                <label for="ppdb_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe PPDB</label>
                <select name="ppdb_type" id="ppdb_type" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                    <option value="">Semua Tipe</option>
                    <option value="Asrama" {{ request('ppdb_type') == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                    <option value="Pulang-Pergi" {{ request('ppdb_type') == 'Pulang-Pergi' ? 'selected' : '' }}>Pulang-Pergi</option>
                </select>
            </div>
            <div id="halaqoh_period_filter" class="w-full md:w-auto {{ request('ppdb_type') == 'Pulang-Pergi' ? '' : 'hidden' }}">
                <label for="halaqoh_period" class="block text-sm font-medium text-gray-700 mb-1">Periode Halaqoh</label>
                <select name="halaqoh_period" id="halaqoh_period" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                    <option value="">Semua Periode</option>
                    <option value="Sore" {{ request('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Sore</option>
                    <option value="Malam" {{ request('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
            </div>
            <div class="w-full md:w-auto">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="re-registered" {{ request('status') == 're-registered' ? 'selected' : '' }}>Re-registered</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="under review" {{ request('status') == 'under review' ? 'selected' : '' }}>Under review</option>
                </select>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="px-5 py-2 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors flex items-center gap-2 w-full md:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Filter
                </button>
                @if (request()->query())
                    <a href="{{ route('admin.applicants.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors flex items-center gap-2 w-full md:w-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if ($allApplicants->isEmpty())
        <p class="text-gray-600 text-center py-8 bg-white rounded-xl shadow-lg border border-gray-200">Belum ada data pendaftar.</p>
    @else
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-600">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">No. Pendaftaran</th>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Tipe PPDB</th>
                            <th class="p-4">Periode Halaqoh</th>
                            <th class="p-4">Tahun Masuk</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800 divide-y divide-gray-200">
                        @foreach ($allApplicants as $applicant)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4">{{ $loop->iteration + ($allApplicants->currentPage() - 1) * $allApplicants->perPage() }}</td>
                                <td class="p-4 font-medium text-gray-900">{{ $applicant->registration_number }}</td>
                                <td class="p-4">{{ $applicant->full_name }}</td>
                                <td class="p-4">
                                    @php
                                        $ppdbType = $applicant->ppdb_type;
                                        $typeClass = match ($ppdbType) {
                                            'Asrama' => 'bg-teal-100 text-teal-800',
                                            'Pulang-Pergi' => 'bg-orange-100 text-orange-800',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClass }}">
                                        {{ $ppdbType ? ucfirst(str_replace('-', ' ', $ppdbType)) : 'Tidak Ada' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @php
                                        $halaqohPeriod = $applicant->halaqoh_period;
                                        $halaqohClass = match ($halaqohPeriod) {
                                            'Sore' => 'bg-purple-100 text-purple-800',
                                            'Malam' => 'bg-indigo-100 text-indigo-800',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $halaqohClass }}">
                                        {{ $halaqohPeriod ? ucfirst(str_replace('-', ' ', $halaqohPeriod)) : 'N/A' }}
                                    </span>
                                </td>
                                <td class="p-4">{{ $applicant->entry_year ?? 'N/A' }}</td>
                                <td class="p-4">
                                    @php
                                        $statusClass = match ($applicant->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'submitted' => 'bg-blue-100 text-blue-800',
                                            'verified' => 'bg-purple-100 text-purple-800',
                                            'accepted', 're-registered' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'under review' => 'bg-yellow-100 text-yellow-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst(str_replace('-', ' ', $applicant->status)) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.applicants.show', $applicant) }}" class="text-blue-600 hover:text-blue-800 transition-colors" title="Lihat">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                              <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>
                                        @can('edit applicants')
                                            <a href="{{ route('admin.applicants.edit', $applicant) }}" class="text-green-600 hover:text-green-800 transition-colors" title="Edit">
                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                 <path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                               </svg>
                                            </a>
                                        @endcan
                                        @can('delete applicants')
                                            <form method="POST" action="{{ route('admin.applicants.destroy', $applicant) }}"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini? Aksi ini tidak dapat dibatalkan.');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus">
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                     <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                                   </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4">
                 {{ $allApplicants->appends(request()->query())->links() }}
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ppdbTypeSelect = document.getElementById('ppdb_type');
            const halaqohPeriodFilter = document.getElementById('halaqoh_period_filter');
            const halaqohPeriodSelect = document.getElementById('halaqoh_period');

            function toggleHalaqohPeriodFilter() {
                if (ppdbTypeSelect.value === 'Pulang-Pergi') {
                    halaqohPeriodFilter.classList.remove('hidden');
                } else {
                    halaqohPeriodFilter.classList.add('hidden');
                    halaqohPeriodSelect.value = '';
                }
            }

            toggleHalaqohPeriodFilter();
            ppdbTypeSelect.addEventListener('change', toggleHalaqohPeriodFilter);
        });
    </script>
@endsection