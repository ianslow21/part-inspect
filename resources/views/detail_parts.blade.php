<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Detail Parts</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card d-flex">
        <div class="card-header">
            <h3>Detail Parts</h3>
        </div>
        <div class="card-body">
            
            <a href="{{ route('parts.index')}}">Kembali</a>
            <br>
            <br>
            <div class="row ml-2">
                <h4 class="col-4">Part Number:</h4>
                <h4>{{$parts->part_number}}</h4>
            </div>
            <div class="row ml-2">
                <h4 class="col-4">Part Name:</h4>
                <h4>{{$parts->part_name}}</h4>
            </div>
            <div class="row ml-2">
                <h4 class="col-4">Supplier:</h4>
                <h4>{{$parts->supplier}}</h4>
            </div>
            <div class="row ml-2">
                <h4 class="col-4">Dimension:</h4>
                <h4>{{$parts->dimension}}</h4>
            </div>
            <div class="row ml-2">
                <h4 class="col-4">Judgement:</h4>
                <h4>{{$parts->judgement}}</h4>
            </div>
            <div class="row ml-2">
                <h4 class="col-4">Pict:</h4>
                <h4> <img src="{{asset('fotoparts/'.$parts->foto)}}" alt="" style= "width:100%"></h4>
            </div>
        </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>