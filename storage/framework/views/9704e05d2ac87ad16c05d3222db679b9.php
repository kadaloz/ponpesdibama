<?php $__env->startPush('scripts'); ?>
<!-- Tom Select CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
    let scheduleIndex = 1;

    const daysOptions = `<?php $__currentLoopData = $daysOfWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($day); ?>"><?php echo e($day); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>`;

    // Tambah Jadwal Dinamis
    document.getElementById('add-schedule-field').addEventListener('click', function () {
        const container = document.getElementById('schedules-container');
        const div = document.createElement('div');

        div.className = 'schedule-item transition-all duration-300 ease-in-out transform bg-white border border-gray-200 rounded-xl p-5 shadow-sm space-y-4 md:space-y-0 md:grid md:grid-cols-12 md:gap-4';
        div.innerHTML = `
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                <select name="schedules[${scheduleIndex}][day_of_week]" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    <option value="">Pilih Hari</option>
                    ${daysOptions}
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                <input type="time" name="schedules[${scheduleIndex}][start_time]" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                <input type="time" name="schedules[${scheduleIndex}][end_time]" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            </div>
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="schedules[${scheduleIndex}][location]" placeholder="Opsional"
                    class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            </div>
            <div class="md:col-span-1 flex md:justify-center">
                <button type="button" onclick="removeScheduleField(this)"
                    class="w-full md:w-auto flex items-center justify-center space-x-2 text-sm text-red-600 hover:text-white hover:bg-red-500 border border-red-500 px-4 py-2 rounded-md font-semibold transition-all duration-200">
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>
        `;
        container.appendChild(div);
        scheduleIndex++;
    });

    // Hapus field dengan animasi keluar
    function removeScheduleField(button) {
        const item = button.closest('.schedule-item');
        item.classList.add('opacity-0', 'scale-95');
        setTimeout(() => item.remove(), 200);
    }

    // Inisialisasi Tom Select
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
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/halaqohs/partials/_script.blade.php ENDPATH**/ ?>