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
                <table class="table table-hover table-bordered table-stripped" id="example2">
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
                </table>
            </div>
        </div>
    </div>
</div>
@stop
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
