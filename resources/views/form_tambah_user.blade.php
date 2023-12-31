<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Tambah User</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

        <div class="card-body">
            <a href = "{{ route('user.index')}}" class = "btn btn-primary">Kembali</a>
            <form action = "{{ route('user.store')}}" method = "POST">
                @csrf
<ul class = "list-group">
    NIK <input type = "text" name = "nik" required>
    Name <input type = "text" name = "name" required>
    <div class="form-group">
        <label>Role</label>
        <select class="form-control" name="role" required>
        <option value="">--Pilih--</option>
        <option value="admin">admin</option>
        <option value="general_user">general_user</option>
        </select>
    </div>
    Email <input type = "email" name = "email" required>
    Password <input type = "password" name = "password" required>
</ul>
<br>
<input type = "submit" value="Simpan Data" class="btn btn-success">
            </form>
        </div>

        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>