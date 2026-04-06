<?php

namespace App\Http\Controllers;

use App\Models\Todo;

use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index()
 {
    //mengambil data dari tabel todos di db dari folder models
    $semuaTugas = Todo::all();

    return view('todos.index',compact ('semuaTugas'));
 }


public function store (Request $request)
{
    //1. menangkap data dari inputan yang bernama task
    //2.menyimpan ke db melewati /models todo

    Todo::create([
        'task' => $request->task,
        'is_completed' => false //false sebagai status awal
    ]);

    //3.setelah menyimpan ke db, selanjutnya memberikan data ke halaman web kembali
    return redirect('/todos');
}


public function update($id)
{
    $todo = Todo::find($id);
    $todo->update([
        'is_completed' => !$todo->is_completed //memngubah status false ke true
    ]);

    return redirect('/todos');
}


public function destroy($id)
{
     $todo = Todo::find($id);
    $todo->delete();

    return redirect('todos');   
}

}