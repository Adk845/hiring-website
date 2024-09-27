@extends('adminlte::page')
@section('title', 'List Departemen')
@section('content_header')
<h1 class="m-0 text-dark">List Departments</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">
                <a href="{{ route('departements.create') }}" class="btn btn-success mb-2">
                    <i class="fa fa-plus"></i> Create Department
                </a>

                <div class="kontainer_department mt-5">
                    @foreach($departements as $key => $departement)
                        <div class="card" style="width: 18rem;">
                            <div class="image_department">                           
                                <img src="{{asset('assets/marketing3.jpg')}}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <div>
                                    <h4 class="">{{ $departement->dep_name }}</h4>
                                </div>  
                                
                                <a href="{{ route('departements.edit', $departement) }}" class="fa fa-edit btn btn-success btn-xs"> Edit</a>
                                <a href="{{ route('departements.destroy', $departement) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                      @endforeach
                </div>

                {{-- <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th>Nama Departemen</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departements as $key => $departement)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $departement->dep_name }}</td>
                            <td>
                                <a href="{{ route('departements.edit', $departement) }}" class="fa fa-edit btn btn-success btn-xs"> Edit</a>
                                <a href="{{ route('departements.destroy', $departement) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>
@stop
<link rel="stylesheet" href="{{asset('css/department.index.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data departemen?')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>
@endpush
