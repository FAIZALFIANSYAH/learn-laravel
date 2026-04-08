<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-12">
        <div class="max-w-5xl mx-auto px-6">

            <!-- Header -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-gray-900">Tugas Saya</h2>
                    <p class="text-gray-500 mt-2">Kelola tugasmu dengan lebih rapi & modern ✨</p>
                </div>

                <a href="{{ route('todos.create') }}"
                   class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-6 py-3 rounded-xl shadow-lg transition hover:scale-105">
                    + Tambah
                </a>
            </div>

            <!-- Filter -->
            <div class="flex gap-3 mb-8 overflow-x-auto pb-2">
                @foreach(['', 'Harian', 'Mingguan', 'Bulanan', 'Tahunan'] as $cat)
                    <a href="{{ route('todos.index', ['category' => $cat]) }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                       {{ request('category') == $cat
                           ? 'bg-indigo-600 text-white shadow'
                           : 'bg-white text-gray-500 border hover:bg-indigo-50' }}">
                        {{ $cat ?: 'Semua' }}
                    </a>
                @endforeach
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-3xl shadow-xl p-8 space-y-5">
                @forelse($allTask as $item)

                    <div class="flex justify-between items-center p-5 rounded-2xl border transition-all hover:shadow-md hover:-translate-y-1 bg-gradient-to-r from-white to-gray-50">

                        <!-- Left -->
                        <div class="flex items-center gap-4">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center
                                {{ $item->is_completed ? 'bg-green-100' : 'bg-indigo-500' }}">
                                @if($item->is_completed)
                                    ✓
                                @endif
                            </div>

                            <div>
                                <p class="text-lg font-semibold
                                    {{ $item->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                    {{ $item->task }}
                                </p>

                                <span class="text-xs text-indigo-500 font-semibold uppercase">
                                    {{ optional($item->category)->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Actions -->
                       <div class="flex gap-2">
    <form action="{{ route('todos.update', $item->id) }}" method="POST">
        @csrf @method('PATCH')
        <button class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $item->is_completed ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
            {{ $item->is_completed ? 'Undo' : 'Done' }}
        </button>
    </form>

    <a href="{{ route('todos.edit', $item->id) }}" 
       class="px-4 py-2 rounded-lg text-sm font-medium bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
        Edit
    </a>

    <form action="{{ route('todos.destroy', $item->id) }}" method="POST">
        @csrf @method('DELETE')
        <button class="px-4 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-600 hover:bg-red-200">
            Hapus
        </button>
    </form>
</div>
                    </div>

                @empty
                    <div class="text-center py-16 text-gray-400">
                        <p class="text-lg">Belum ada tugas 😴</p>
                        <p class="text-sm">Klik tombol tambah untuk mulai</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>