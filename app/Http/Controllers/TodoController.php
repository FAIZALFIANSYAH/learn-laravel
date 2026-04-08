<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Menampilkan daftar tugas milik user yang sedang login.
     */
    public function index()
    {
        // Filter: Hanya ambil data yang punya user_id sesuai user yang login
        // Jika kamu belum menambah kolom user_id di database, gunakan Todo::all() dulu
        $allTask = Todo::where('user_id', Auth::id())->latest()->get();

        return view('todos.index', compact('allTask'));
    }

    /**
     * Menyimpan tugas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Todo::create([
            'user_id' => Auth::id(), // Hubungkan tugas dengan ID user yang login
            'task' => $request->task,
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
}