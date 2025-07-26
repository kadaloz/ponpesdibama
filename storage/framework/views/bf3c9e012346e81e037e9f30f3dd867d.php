<?php $__env->startSection('title', 'Tempatkan Santri ke Kamar'); ?>
<?php $__env->startSection('header_admin', 'Tempatkan Santri ke Kamar Asrama'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-6">Form Penempatan Santri Baru</h3>

        <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo e(session('error')); ?></span>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.placements.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Pilih Santri <span class="text-red-500">*</span></label>
                    <select id="student_id" name="student_id" autocomplete="off">
                        <option value="">Cari dan pilih santri...</option>
                    </select>
                    <span id="students-loading" class="text-sm text-gray-500 hidden">Memuat data santri...</span>
                    <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700">Pilih Kamar <span class="text-red-500">*</span></label>
                    <select name="room_id" id="room_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 <?php $__errorArgs = ['room_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">-- Pilih Kamar --</option>
                        <?php $__currentLoopData = $availableRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->id); ?>"
                                <?php echo e(old('room_id') == $room->id ? 'selected' : ''); ?>

                                data-gender="<?php echo e($room->gender_type); ?>"
                                data-capacity="<?php echo e($room->capacity); ?>"
                                data-occupancy="<?php echo e($room->currentOccupancy()); ?>">
                                <?php echo e($room->room_number); ?> (<?php echo e($room->currentOccupancy()); ?>/<?php echo e($room->capacity); ?> - <?php echo e(ucfirst($room->gender_type)); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['room_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Menempati <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('start_date', date('Y-m-d'))); ?>" required>
                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="mt-6 flex justify-end space-x-3">
                <a href="<?php echo e(route('admin.placements.index')); ?>" class="px-4 py-2 bg-gray-200 rounded font-semibold text-xs text-gray-700 hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded font-semibold text-xs hover:bg-teal-700">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> Tempatkan Santri
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadingText = document.getElementById('students-loading');
    const roomSelect = document.getElementById('room_id');

    const tomSelect = new TomSelect('#student_id', {
        valueField: 'value',
        labelField: 'text',
        searchField: ['text'],
        placeholder: 'Cari dan pilih santri...',
        load: function(query, callback) {
            if (!query.length) return callback();

            loadingText.classList.remove('hidden');

            fetch(`/api/available-students?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    loadingText.classList.add('hidden');
                    callback(data);
                })
                .catch(() => callback());
        },
        onChange: function() {
            filterRooms();
        }
    });

    function filterRooms() {
        const selected = tomSelect.options[tomSelect.getValue()];
        if (!selected) return;

        const studentGenderMatch = selected.text.match(/-\s*(\w+)$/);
        const studentGender = studentGenderMatch ? studentGenderMatch[1].toLowerCase() : null;

        Array.from(roomSelect.options).forEach(option => {
            option.style.display = '';
            if (!option.value) return;

            const roomGender = option.dataset.gender?.toLowerCase();
            const roomCapacity = parseInt(option.dataset.capacity);
            const roomOccupancy = parseInt(option.dataset.occupancy);

            const genderMismatch = studentGender && roomGender !== studentGender;
            const fullRoom = roomOccupancy >= roomCapacity;

            option.disabled = fullRoom;
            option.textContent = option.textContent.replace(' (PENUH)', '');
            if (genderMismatch) {
                option.style.display = 'none';
            } else if (fullRoom) {
                option.textContent += ' (PENUH)';
            }
        });

        if (roomSelect.selectedOptions[0]?.disabled || roomSelect.selectedOptions[0]?.style.display === 'none') {
            roomSelect.value = "";
        }
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/admin/placements/create.blade.php ENDPATH**/ ?>