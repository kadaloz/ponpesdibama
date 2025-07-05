@push('scripts')
<!-- Tom Select CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
    let newScheduleIndex = {{ $halaqoh->schedules->count() }};
    const daysOptions = `@foreach($daysOfWeek as $day)<option value="{{ $day }}">{{ $day }}</option>@endforeach`;

    // Tambah jadwal baru secara dinamis (tanpa ID)
    document.getElementById('add-schedule-edit').addEventListener('click', function () {
        const container = document.getElementById('new-schedules');
        const div = document.createElement('div');
        div.className = 'schedule-item transition-all duration-300 ease-in-out transform bg-white border border-gray-200 rounded-xl p-5 shadow-sm grid grid-cols-12 gap-4 items-end';
        div.innerHTML = `
            <div class="col-span-3">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                <select name="schedules[${newScheduleIndex}][day_of_week]" class="form-input">
                    <option value="">Pilih Hari</option>
                    ${daysOptions}
                </select>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                <input type="time" name="schedules[${newScheduleIndex}][start_time]" class="form-input">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                <input type="time" name="schedules[${newScheduleIndex}][end_time]" class="form-input">
            </div>
            <div class="col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="schedules[${newScheduleIndex}][location]" class="form-input" placeholder="Opsional">
            </div>
            <div class="col-span-1 flex justify-center">
                <button type="button" onclick="removeScheduleField(this)" class="px-2 py-1.5 text-xs text-red-600 hover:text-white hover:bg-red-500 border border-red-500 rounded-md font-medium flex items-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg> Hapus
                </button>
            </div>
        `;
        container.appendChild(div);
        newScheduleIndex++;
    });

    // Hapus dari DOM (tanpa ID)
    function removeScheduleField(button, scheduleId = null) {
        const item = button.closest('.schedule-item');

        if (scheduleId) {
            if (confirm('Apakah kamu yakin ingin menghapus jadwal ini dari database?')) {
                fetch(`/admin/halaqohs/schedules/${scheduleId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        item.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => item.remove(), 200);
                    } else {
                        alert('Gagal menghapus jadwal.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus jadwal.');
                });
            }
        } else {
            // Langsung hapus item baru (belum ada ID)
            item.classList.add('opacity-0', 'scale-95');
            setTimeout(() => item.remove(), 200);
        }
    }

    // Inisialisasi Tom Select untuk pilihan santri
    document.addEventListener('DOMContentLoaded', function () {
        new TomSelect("#selected_students", {
            plugins: ['remove_button'],
            persist: false,
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: 'Cari dan pilih santri...',
        });
    });
</script>
@endpush
