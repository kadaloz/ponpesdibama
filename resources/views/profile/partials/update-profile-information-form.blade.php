<section x-data="profilePhotoCropper()" x-init="init()">
  
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

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />
            <div class="mt-2 flex items-center gap-4">
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
                        @change="handleFileChange($event)">
                    <x-input-error class="mt-2" :messages="$errors->get('photo_path')" />
                </div>

                @if ($user->photo_path)
                    <form action="{{ route('admin.profile.deletePhoto') }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus foto profil?')"
                                class="px-4 py-2 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 focus:ring">
                            Hapus Foto
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Nama --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Hidden untuk base64 --}}
        <input type="hidden" name="cropped_photo_data" id="cropped_photo_data">

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    {{-- Modal Crop --}}
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" x-show="open" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full mx-4">
            <h3 class="text-lg font-bold mb-4">Crop Foto</h3>
            <div class="max-h-96 overflow-hidden">
                <img x-ref="image" :src="imageUrl" alt="Preview" class="block max-w-full h-auto rounded">
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" @click="resetCropper()"
                        class="px-4 py-2 text-sm text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">
                    Batal
                </button>
                <button type="button" @click="applyCrop()"
                        class="px-4 py-2 text-sm text-white bg-violet-600 hover:bg-violet-700 rounded">
                    Crop & Simpan
                </button>
            </div>
        </div>
    </div>
</section>
