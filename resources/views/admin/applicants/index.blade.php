{{-- resources/views/admin/applicants/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran PSB')

@section('header_admin', 'Manajemen Pendaftaran PSB')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h3 class="text-2xl md:text-3xl font-bold text-teal-700 mb-4 md:mb-0">Daftar Calon Santri</h3>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white p-4 rounded-lg shadow-md mb-6 border border-gray-200">
                <form action="{{ route('admin.applicants.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari (Nama/No.Pendaftaran):</label>
                        <input type="text" name="search" id="search" placeholder="Cari..." value="{{ request('search') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                    </div>
                    <div>
                        <label for="entry_year" class="block text-sm font-medium text-gray-700 mb-1">Filter Tahun Masuk:</label>
                        <select name="entry_year" id="entry_year" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                            <option value="">Semua Tahun</option>
                            @foreach ($availableYears as $year)
                                <option value="{{ $year }}" {{ request('entry_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="ppdb_type" class="block text-sm font-medium text-gray-700 mb-1">Filter Tipe PPDB:</label>
                        <select name="ppdb_type" id="ppdb_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                            <option value="">Semua Tipe</option>
                            <option value="Asrama" {{ request('ppdb_type') == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                            <option value="Pulang-Pergi" {{ request('ppdb_type') == 'Pulang-Pergi' ? 'selected' : '' }}>Pulang-Pergi</option>
                        </select>
                    </div>

                    <div id="halaqoh_period_filter" class="{{ request('ppdb_type') == 'Pulang-Pergi' ? '' : 'hidden' }}">
                        <label for="halaqoh_period" class="block text-sm font-medium text-gray-700 mb-1">Filter Periode Halaqoh:</label>
                        <select name="halaqoh_period" id="halaqoh_period" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                            <option value="">Semua Periode</option>
                            <option value="Sore" {{ request('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Sore</option>
                            <option value="Malam" {{ request('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Malam</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status:</label>
                        <select name="status" id="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm p-2">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="accepted" {{ request('status') == 'accepted' || request('status') == 're-registered' ? 'selected' : '' }}>Accepted/Re-registered</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="flex space-x-2 col-span-full md:col-span-1 md:col-start-auto">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01.293.707V19a1 1 0 01-1 1H4a1 1 0 01-1-1v-6.586a1 1 0 01.293-.707L3 4z"></path></svg>
                            Filter
                        </button>
                        @if (request('ppdb_type') || request('status') || request('halaqoh_period') || request('entry_year') || request('search'))
                            <a href="{{ route('admin.applicants.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Bersihkan Filter
                            </a>
                        @endif
                    </div>
                </form>

                @if (request('ppdb_type') || request('status') || request('halaqoh_period') || request('entry_year') || request('search'))
                    <div class="mt-4 text-sm text-gray-600">
                        <p>Filter Aktif:
                            @if (request('search'))
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Pencarian: "{{ request('search') }}"</span>
                            @endif
                            @if (request('entry_year'))
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Tahun Masuk: {{ request('entry_year') }}</span>
                            @endif
                            @if (request('ppdb_type'))
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Tipe PPDB: {{ ucfirst(str_replace('-', ' ', request('ppdb_type'))) }}</span>
                            @endif
                            @if (request('halaqoh_period'))
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Periode Halaqoh: {{ ucfirst(str_replace('-', ' ', request('halaqoh_period'))) }}</span>
                            @endif
                            @if (request('status'))
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Status: {{ ucfirst(str_replace('-', ' ', request('status'))) }}</span>
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            @if ($allApplicants->isEmpty())
                <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">Belum ada data pendaftar.</p>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No.</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No. Pendaftaran</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tahun Masuk</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">PPDB Tipe</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Halaqoh Periode</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allApplicants as $applicant)
                                <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $loop->iteration + ($allApplicants->currentPage() - 1) * $allApplicants->perPage() }}</td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $applicant->registration_number }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $applicant->full_name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $applicant->entry_year ?? 'N/A' }}</td>
                                    <td class="py-4 px-6 text-sm">
                                        @php
                                            $ppdbType = $applicant->ppdb_type;
                                            $typeClass = match ($ppdbType) {
                                                'Asrama' => 'bg-teal-100 text-teal-800',
                                                'Pulang-Pergi' => 'bg-orange-100 text-orange-800',
                                                default => 'bg-gray-100 text-gray-700'
                                            };
                                        @endphp

                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClass }}">
                                            {{ $ppdbType ? ucfirst(str_replace('-', ' ', $ppdbType)) : 'Tidak Ada' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm">
                                        @php
                                            $halaqohPeriod = $applicant->halaqoh_period; // Corrected to halaqoh_period
                                            $halaqohClass = match ($halaqohPeriod) {
                                                'Sore' => 'bg-purple-100 text-purple-800',
                                                'Malam' => 'bg-indigo-100 text-indigo-800',
                                                default => 'bg-gray-100 text-gray-700'
                                            };
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $halaqohClass }}">
                                            {{ $halaqohPeriod ? ucfirst(str_replace('-', ' ', $halaqohPeriod)) : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                            $applicant->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                            ($applicant->status == 'submitted' ? 'bg-blue-100 text-blue-800' :
                                            ($applicant->status == 'verified' ? 'bg-purple-100 text-purple-800' :
                                            ($applicant->status == 'accepted' || $applicant->status == 're-registered' ? 'bg-green-100 text-green-800' :
                                            ($applicant->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))))
                                        }}">
                                            {{ ucfirst(str_replace('-', ' ', $applicant->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
                                            <div>
                                                <button type="button" @click="open = !open" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                                                    Aksi
                                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>

<div x-show="open" class="origin-top-right absolute right-0 mt-2 w-52 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50" x-transition>
    <div class="py-2 text-sm text-gray-700">
        @can('view applicants')
            <a href="{{ route('admin.applicants.show', $applicant) }}"
               class="flex items-center px-4 py-2 hover:bg-gray-100 gap-2">
                <x-icon-eye class="w-4 h-4 text-gray-500" />
                Lihat
            </a>
        @endcan
        @can('edit applicants')
            <a href="{{ route('admin.applicants.edit', $applicant) }}"
               class="flex items-center px-4 py-2 hover:bg-gray-100 gap-2">
                <x-icon-pencil class="w-4 h-4 text-gray-500" />
                Edit
            </a>
        @endcan
        @can('delete applicants')
            <form action="{{ route('admin.applicants.destroy', $applicant) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-100 gap-2">
                    <x-icon-trash class="w-4 h-4" />
                    Hapus
                </button>
            </form>
        @endcan
    </div>
</div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  <div class="mt-4">
                 {{ $allApplicants->appends(request()->query())->links() }}
                  </div>
                </div>
            @endif
        </div>
    </div>

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
