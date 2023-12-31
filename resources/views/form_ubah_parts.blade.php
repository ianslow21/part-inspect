<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ubah Parts</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

        <div class="card-body">
            <a href = "{{ route('parts.index')}}" class = "btn btn-primary">Kembali</a>
            <form action = "{{ route('parts.update', $parts->id)}}" method = "POST" enctype = "multipart/form-data">
                @csrf
                @method('PUT')
<ul class = "list-group">

    Part Number <input type = "text" name = "part_number" value="{{ $parts->part_number }}" required @can('isGeneral_User') readonly @endcan>
    Part Name <input type = "text" name = "part_name" value="{{ $parts->part_name }}" required @can('isGeneral_User') readonly @endcan>
    Supplier <input type = "text" name = "supplier" value="{{ $parts->supplier }}" required @can('isGeneral_User') readonly @endcan>
    @can('isGeneral_User')
    Dimension <input type = "text" name = "dimension" value="{{ $parts->dimension }}" required>
    @endcan
    @can('isGeneral_User')
    Judgement <div class="form-check form-check-inline" value="{{ $parts->judgement }}">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="judgement" id="inlineRadio1" value="OK" {{$parts->judgement == 'OK'? 'checked' : ''}} required>
            <label class="form-check-label" for="inlineRadio1">OK</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="judgement" id="inlineRadio2" value="NG" {{$parts->judgement == 'NG'? 'checked' : ''}} required>
            <label class="form-check-label" for="inlineRadio2">NG</label>
        </div>
    </div>
    @endcan
    @can('isGeneral_User')
    Pict <input type = "file" name = "foto" value="{{ $parts->foto }}" required>
    @endcan

    <br>
    <div class="form-group">
        <img src="{{asset('fotoparts/'.$parts->foto)}}" alt="" height="10%" width="50%" ">
    </div>
</ul>
<br>
<input type = "submit" value="Ubah Data" class="btn btn-success">
            </form>
        </div>

        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>