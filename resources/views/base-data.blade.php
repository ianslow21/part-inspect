<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Base Data</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Part Name</th>
                        <th>Part No.</th>
                        <th>Dimension</th>
                        <th>Judgement</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
                
                        </table>
            </div>
        </div>

        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>