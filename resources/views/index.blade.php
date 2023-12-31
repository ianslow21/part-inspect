<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
<!-- for delete selected -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Parts</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    
        <div class="card-body">
            <form class="form" method="get" action="{{ route('search') }}">
                <div class="col-md-4 col-md-4 col-md-4">
                    <label for="search" class="d-block ml-30">Pencarian</label>
                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                    <button type="submit" class="btn btn-primary mb-1">Cari</button>
                </div>
            </form>
            
            @can('isAdmin')
            <a href="{{ route('parts.create')}}" class="btn btn-warning me-1">Tambah Data Parts</a>
            @endcan
            <button class="btn btn-primary me-1" onclick="ExportToExcel('xlsx')">Export All Data</button>
            @can('isAdmin')
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        Import Data
        </button>
        @endcan
    </div>
            <br>
            <br>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
    @can('isAdmin')
        <button style="margin: 10px" class="btn btn-dark delete_all" data-url="{{ url('partsDeleteAll') }}">Delete All Selected</button>
      @endcan
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-table">
                <thead>
                    <tr>
                        @can('isAdmin')
                        <th width="50px"><input type="checkbox" id="master"></th>
                        @endcan
                        <th>No.</th>
                        <th>Part No.</th>
                        <th>Part Name</th>
                        <th>Supplier</th>
                        <th>Dimension</th>
                        <th>Judgement</th>
                        <th>Pict</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($parts->count())
            @foreach($parts as $p)
                    <tr id="tr_{{$p->id}}">
                    @can('isAdmin')
                    <td><input type="checkbox" class="sub_chk" data-id="{{$p->id}}"></td>
                    @endcan
                    <td>{{$loop->iteration}}</td>
                    <td>{{$p->part_number}}</td>
                    <td>{{$p->part_name}}</td>
                    <td>{{$p->supplier}}</td>
                    <td>{{$p->dimension}}</td>
                    <td>{{$p->judgement}}</td>
                    <td>
                    <img src="{{asset('fotoparts/'.$p->foto)}}" alt="" style="width: 40px;">
                    </td>
                        <td>
                            <ul class="nav">
                                <a href="{{route ('parts.show', $p->id)}}" class="btn btn-success me-1">Show</a>
                                <a href="{{route ('parts.edit', $p->id)}}" class="btn btn-primary me-1">Edit</a>
                                <form action ="{{route ('parts.destroy', $p->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('isAdmin')
                                    <button onclick="return confirm('Apakah yakin ingin menghapus data ini?')" type="submit" class="btn btn-warning">Delete</button>
                                    @endcan
                                </form>
                            </ul>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @endif
                        </table>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Import CSV Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Export All Data -->
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('data-table');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('DataAllParts.' + (type || 'xlsx')));
        }
</script>

<!-- Delete All Data -->
<script type="text/javascript">
    $(document).ready(function () {

        $('#master').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".sub_chk").prop('checked', true);  
        } else {  
            $(".sub_chk").prop('checked',false);  
        }  
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Pilih baris data terlebih dahulu...");  
            }  else {  

                var check = confirm("Yakin ingin menghapus baris ini ?");  
                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Terjadi kesalahan !!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Terjadi kesalahan!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script>


    </body>
</html>
