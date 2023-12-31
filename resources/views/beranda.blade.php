<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
 <title>Beranda PI</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <div class="jumbotron text-center">
        <h1>Sistem Receiving Incoming Parts</h1>
        <p>Welcome To PI Receiving Systems !</p>
        @can('isAdmin')
        <a href="user" class="btn btn-primary">Manajemen User</a>
        @endcan
        @can('isAdminGeneral_User')
        <a href="parts" class="btn btn-warning">Parts</a>
        @endcan

        <br />
        <br />

        <div class="container d-flex justify-content-center">
            <div class="card d-flex">
                <div class="card-header">
                    <h3>Lets start inspecting incoming parts !</h3>
                </div>
                <div class="card-body">
                    <div class="row ml-2">
                        <h4><img src="{{asset('pict/part inspection wallpaper.jpg')}}" alt="" style="width:100%" /></h4>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
