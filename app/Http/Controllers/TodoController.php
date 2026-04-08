<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class TodoController extends Controller
{
    /**
     * Menampilkan daftar tugas milik user yang sedang login.
     */
    public function index(Request $request)
{
    $query = Todo::query();

    // Jika ada filter kategori di URL (contoh: ?category=Harian)
    if ($request->has('category') && $request->category != '') {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('name', $request->category);
        });
    }

    $allTask = $query->get();
    
    // Pastikan variabel ini dikirim ke view
    return view('todos.index', compact('allTask'));
}

public function create()
{
    $categories = Category::all();
    return view('todos.create', compact('categories'));
}

    /**
     * Menyimpan tugas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        Todo::create([
            'user_id' => Auth::id(), // Hubungkan tugas dengan ID user yang login
            'task' => $request->task,
            'category_id' => $request->category_id,
            'is_completed' => false
        ]);

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil ditambah!');
    }

    /**
     * Mengubah status (Selesai/Batal).
     */
    public function update($id)
    {
        // Temukan tugas, tapi pastikan itu milik user yang login (keamanan extra)
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return redirect()->back();
    }

    /**
     * Menghapus tugas.
     */
    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }

    public function edit(Todo $todo)
{
    $categories = Category::all();
    return view('todos.edit', compact('todo', 'categories'));
}

public function updateTask(Request $request, Todo $todo)
{
    $request->validate([
        'task' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
    ]);

    $todo->update([
        'task' => $request->task,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('todos.index')->with('success', 'Tugas diperbarui!');
}
}