<h3 class="text-2xl font-semibold text-teal-700 mb-6 border-b pb-2 pt-6">Santri dalam Halaqoh</h3>
<p class="text-sm text-gray-600 mb-4">Pilih santri yang akan tergabung dalam halaqoh ini. Anda dapat memilih lebih dari satu.</p>

<div class="mb-6">
    <label for="selected_students" class="block text-sm font-semibold text-gray-700">Pilih Santri</label>
    <select name="selected_students[]" id="selected_students" multiple
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 h-52">
        @foreach ($students as $student)
            <option value="{{ $student->id }}" data-data='{"type": "{{ $student->type ?? 'N/A' }}"}'>
                {{ $student->name }} (NIS: {{ $student->nis ?? '-' }}) - Tipe: {{ $student->type ?? 'N/A' }}
            </option>
        @endforeach
    </select>
    @error('selected_students') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    @error('selected_students.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
