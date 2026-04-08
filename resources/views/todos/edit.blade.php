<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 flex items-center justify-center">
        <div class="max-w-md w-full px-6">
            <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Edit Tugas</h2>

                <form action="{{ route('todos.update-task', $todo->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Nama Tugas</label>
                        <input type="text" name="task" value="{{ $todo->task }}" required
                               class="w-full border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 py-4 px-5 text-gray-600 shadow-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Ubah Kategori</label>
                        <select name="category_id" required class="w-full border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 py-4 px-5 text-gray-500 bg-white shadow-sm cursor-pointer">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $todo->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-3 pt-6">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg transition-all active:scale-[0.98]">
                            Simpan Perubahan
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