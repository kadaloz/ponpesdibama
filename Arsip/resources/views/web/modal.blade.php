{{-- resources/views/web/modal.blade.php --}}
<!-- Modal for Activity Idea -->
<div id="activityModal" class="modal">
    <div class="modal-content text-gray-800">
        <span class="close-button" id="closeActivityModal">&times;</span>
        <h3 class="text-2xl font-bold text-teal-700 mb-4">Ide Kegiatan Santri ✨</h3>
        <p id="activityIdeaContent" class="text-lg mb-4">Memuat ide...</p>
        <div id="activityModalSpinner" class="flex justify-center items-center py-4">
            <svg class="animate-spin h-8 w-8 text-teal-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
</div>
