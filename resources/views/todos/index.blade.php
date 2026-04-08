<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tugas Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('todos.store') }}" method="POST" class="flex gap-3 mb-8">
                    @csrf
                    <input type="text" name="task" placeholder="Apa yang ingin kamu kerjakan hari ini?" required
                           class="border-gray-300 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg shadow-sm w-full transition duration-200">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md">
                        Tambah
                    </button>
                </form>

                <div class="space-y-4">
                    @forelse($semuaTugas as $item)
                        <div class="group flex items-center justify-between p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-indigo-200 hover:shadow-md transition duration-200">
                            <div class="flex items-center gap-4">
                                <div class="w-2 h-2 rounded-full {{ $item->is_completed ? 'bg-green-400' : 'bg-indigo-400' }}"></div>
                                
                                <span class="text-lg font-medium {{ $item->is_completed ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                    {{ $item->task }}
                                </span>
                            </div>

                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <form action="/todos/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg border transition duration-200 
                                            {{ $item->is_completed 
                                                ? 'bg-orange-50 text-orange-600 border-orange-200 hover:bg-orange-100' 
                                                : 'bg-green-50 text-green-600 border-green-200 hover:bg-green-100' }}">
                                        {{ $item->is_completed ? 'Batal' : 'Selesai' }}
                                    </button>
                                </form>

                                <form action="/todos/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg border border-red-100 bg-red-50 text-red-600 hover:bg-red-100 transition duration-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-gray-400 italic">Belum ada tugas. Mulai harimu dengan menambah tugas baru!</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition duration-200">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>