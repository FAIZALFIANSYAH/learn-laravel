<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 flex items-center justify-center">
        <div class="max-w-md w-full px-6">
            <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Tugas Baru</h2>

                <form action="{{ route('todos.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Apa rencanamu?</label>
                        <input type="text" name="task" placeholder="Misal: Push Rank 5 Stars" required
                               class="w-full border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 py-4 px-5 text-gray-600 shadow-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Pilih Kategori</label>
                        <select name="category_id" required class="w-full border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 py-4 px-5 text-gray-500 bg-white shadow-sm transition-all cursor-pointer">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-3 pt-6">
                        <button type="submit" class="w-full bg-[#5850EC] hover:bg-[#4d45d1] text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-[0.98]">
                            Simpan Tugas
                        </button>
                        <a href="{{ route('todos.index') }}" class="text-center py-2 text-xs font-bold text-gray-400 hover:text-gray-600 transition uppercase tracking-widest">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>