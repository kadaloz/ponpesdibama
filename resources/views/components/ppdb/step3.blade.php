<div x-data="ppdbForm()" x-init="$nextTick(() => ppdbType = '')" id="ppdbForm">
    <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

    {{-- Pilih Program --}}
    <x-form.group name="chosen_program" label="Pilih Program">
        <x-form.select
            id="chosen_program"
            name="chosen_program"
            :options="$programs->pluck('name', 'id')->toArray()"
            placeholder="Pilih Program"
            required
        />
    </x-form.group>

    {{-- Tipe Pendaftaran --}}
    <x-form.group name="ppdb_type" label="Tipe Pendaftaran">
        <div class="flex flex-col gap-4 sm:flex-row sm:gap-6">
            @foreach (\App\Enums\PpdbType::cases() as $type)
                @php
                    $disabled = ($type->value === 'Asrama' && empty($settings['ppdb_asrama_open']))
                             || ($type->value === 'Pulang-Pergi' && empty($settings['ppdb_pulang_pergi_open']));
                @endphp
                <label class="inline-flex items-center space-x-2">
                    <input
                        type="radio"
                        name="ppdb_type"
                        value="{{ $type->value }}"
                        x-model="ppdbType"
                        class="text-teal-600 focus:ring-teal-500"
                        @disabled($disabled)
                    >
                    <span class="{{ $disabled ? 'text-gray-400 line-through' : '' }}">
                        {{ $type->label() }}
                    </span>
                </label>
            @endforeach
        </div>
    </x-form.group>

    {{-- Periode Halaqoh (Jika Pulang-Pergi) --}}
    <template x-if="ppdbType === 'Pulang-Pergi'">
        <x-form.group
            name="halaqoh_period"
            label="Periode Halaqoh"
            x-transition:enter="transition ease-out duration-300"
            x-transition:leave="transition ease-in duration-200"
        >
            <x-form.select
                id="halaqoh_period"
                name="halaqoh_period"
                :options="collect(\App\Enums\HalaqohPeriod::cases())->mapWithKeys(fn($p) => [$p->value => $p->label()])->toArray()"
                placeholder="Pilih Periode"
                x-bind:required="ppdbType === 'Pulang-Pergi'"
            />
        </x-form.group>
    </template>

    {{-- Upload Dokumen (Opsional) --}}
    <div class="space-y-4 pt-6">
        @foreach ([
            'akta' => ['label' => 'Akta Kelahiran', 'accept' => '.pdf,.jpg,.jpeg,.png'],
            'kk' => ['label' => 'Kartu Keluarga (KK)', 'accept' => '.pdf,.jpg,.jpeg,.png'],
            'ijazah' => ['label' => 'Ijazah Terakhir', 'accept' => '.pdf,.jpg,.jpeg,.png'],
            'photo' => ['label' => 'Pas Foto', 'accept' => '.jpg,.jpeg,.png'], // Khusus foto
        ] as $key => $config)
            <x-form.group name="document_{{ $key }}" label="{{ $config['label'] }} (Opsional)">
                <x-form.file
                    id="document_{{ $key }}"
                    name="document_{{ $key }}"
                    accept="{{ $config['accept'] }}"
                />
            </x-form.group>
        @endforeach
    </div>
</div>
