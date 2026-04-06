<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To-Do List</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Daftar Tugas Saya</h1>

                        <form action="/todos" method="POST" class="input-group mb-3">
                            @csrf
                            <input type="text" name="task" class="form-control" placeholder="Ketik tugas baru..." required>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </form>

                        <hr>

                        <ul class="list-group">
                            @foreach($semuaTugas as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span style="{{ $item->is_completed ? 'text-decoration: line-through;' : '' }}">
                                        {{ $item->task }}
                                    </span>

                                    <div class="btn-group">
                                        <form action="/todos/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                {{ $item->is_completed ? 'Batal' : 'Selesai' }}
                                            </button>
                                        </form>

                                        <form action="/todos/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1">Hapus</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>