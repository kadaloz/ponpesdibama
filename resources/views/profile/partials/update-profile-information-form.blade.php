<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, photo and email address.") }}
        </p>
    </header>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg my-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg my-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data" x-data="{ 
        open: false, 
        imageUrl: '', 
        cropper: null,
        resetCropper() {
            this.open = false;
            this.imageUrl = '';
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
            document.getElementById('photo').value = '';
        }
    }">
        @csrf
        @method('patch')

        {{-- Profile Photo Section --}}
        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />
            <div class="mt-2 flex items-center gap-4">
                {{-- OLD FOTO --}}
                <div class="flex-shrink-0">
                    @if ($user->photo_path)
                        <img src="{{ asset('storage/' . $user->photo_path) }}" alt="Profile Photo" class="h-20 w-20 rounded-full object-cover">
                    @else
                        <svg class="h-20 w-20 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 1.486 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                </div>
                <div class="flex-grow">
                    <input type="file" id="photo" name="photo_file" class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        accept="image/*"
                        x-on:change="
                            const file = $event.target.files[0];
                            if (file) {
                                imageUrl = URL.createObjectURL(file);
                                open = true;
                                $nextTick(() => {
                                    cropper = new Cropper($refs.image, {
                                        aspectRatio: 1,
                                        viewMode: 1,
                                        autoCropArea: 0.8,
                                        movable: false,
                                        zoomable: false,
                                    });
                                });
                            }
                        ">
                    <x-input-error class="mt-2" :messages="$errors->get('photo_path')" />
                </div>
                {{-- Tombol Hapus Foto --}}
                @if ($user->photo_path)
                    <form action="{{ route('admin.profile.deletePhoto') }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Hapus Foto
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Nama, Email, dll. --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>...</div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>

        {{-- Hidden input untuk menyimpan hasil crop --}}
        <input type="hidden" id="cropped_photo_data" name="cropped_photo_data">
    </form>
</section>

{{-- Modal Cropper.js --}}
<div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center" x-show="open" x-cloak>
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full mx-4">
        <h3 class="text-lg font-bold mb-4">Crop Foto</h3>
        <div class="max-w-lg max-h-96">
            <img x-ref="image" :src="imageUrl" alt="Crop Image" class="block max-w-full h-auto">
        </div>
        <div class="mt-4 flex justify-end gap-2">
            <button type="button" @click="resetCropper()" class="px-4 py-2 text-sm font-semibold rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                Batal
            </button>
            <button type="button" @click="
                const croppedData = cropper.getCroppedCanvas({ width: 256, height: 256 }).toDataURL();
                document.getElementById('cropped_photo_data').value = croppedData;
                resetCropper();
            " class="px-4 py-2 text-sm font-semibold rounded-md text-white bg-violet-600 hover:bg-violet-700">
                Crop & Simpan
            </button>
        </div>
    </div>
</div>

{{-- Cropper.js CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>