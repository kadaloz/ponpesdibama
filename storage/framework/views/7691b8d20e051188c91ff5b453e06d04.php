<?php $__env->startSection('title', 'Pendaftaran PPDB Online - PonpesDIBAMA'); ?>

<?php $__env->startSection('main_content'); ?>
<section id="ppdb-form" class="py-16 md:py-24 bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-teal-700 drop-shadow-sm">Formulir Pendaftaran PPDB Online</h2>
            <p class="text-lg mt-2 text-gray-600 max-w-2xl mx-auto">
                Isi data diri calon santri dan wali, serta unggah dokumen yang diperlukan.
            </p>
        </div>

        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl max-w-4xl mx-auto">
            <?php if ($__env->exists('components.ppdb.requirements')) echo $__env->make('components.ppdb.requirements', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <form
                id="ppdbForm"
                x-data="ppdbForm()"
                @submit.prevent="handleSubmit"
                action="<?php echo e(route('ppdb.store')); ?>"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6 text-left"
                autocomplete="off"
            >
                <?php echo csrf_field(); ?>

                
                <div x-show="step === 1" class="step" id="step-1">
                    <?php echo $__env->make('components.ppdb.step1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div x-show="step === 2" class="step" id="step-2">
                    <?php echo $__env->make('components.ppdb.step2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div x-show="step === 3" class="step" id="step-3">
                    <?php echo $__env->make('components.ppdb.step3', ['programs' => $programs], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div class="flex justify-between mt-6">
                    <button
                        type="button"
                        x-show="step > 1"
                        @click="prevStep"
                        class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition"
                    >
                        Kembali
                    </button>

                    <button
                        type="button"
                        x-show="step < 3"
                        @click="nextStep"
                        class="px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition"
                    >
                        Lanjut
                    </button>

                    <button
                        type="submit"
                        x-show="step === 3"
                        class="px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition"
                    >
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('services.recaptcha.site_key')); ?>"></script>
<script>
    window.recaptchaSiteKey = "<?php echo e(config('services.recaptcha.site_key')); ?>";
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.apps', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/public/applicants/create.blade.php ENDPATH**/ ?>