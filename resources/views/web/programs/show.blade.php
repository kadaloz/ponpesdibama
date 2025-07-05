    {{-- resources/views/programs/show.blade.php --}}
    @extends('web.apps')

    @section('title', $program->name . ' - Program PonpesDIBAMA')

    @section('main_content')
        <div class="py-12 bg-gray-50">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-teal-700 leading-tight mb-6 text-center tracking-tight">{{ $program->name }}</h1>

                        <p class="text-sm text-gray-500 text-center mb-8 italic">
                            Durasi Program: <span class="font-medium">{{ $program->duration ?? 'Tidak Diketahui' }}</span>
                        </p>

                        <div class="prose prose-lg mx-auto text-gray-800 leading-relaxed text-justify mb-10">
                            <p>{!! nl2br(e($program->description)) !!}</p>
                        </div>

                        <div class="mt-8 text-center border-t pt-6">
                            <a href="{{ url('/') }}#program" class="inline-flex items-center px-6 py-3 bg-teal-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Kembali ke Program
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    