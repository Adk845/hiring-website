@extends('adminlte::page')
@section('title', 'Tambah Departemen')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Departemen</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('departements.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dep_name">Nama Departemen</label>
                        <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="Masukkan nama departemen" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('departements.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
