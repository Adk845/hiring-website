@extends('adminlte::page')

@section('title', 'List Educatiom')

@section('content_header')
<h1 class="m-0 text-dark"><b>List Education</b></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="search-bar me-3">
                        <form action="{{ route('education.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Search Education..." value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('education.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create Education
                    </a>
                </div>

                <div class="kontainer_department mt-5 d-flex flex-wrap">
                    @foreach($education as $education)
                    <div class="card me-3 mb-3" style="width: 18rem;">
                        <a href="{{ route('showEducationMajor', $education->id) }}" class="major_page">
                            <div class="image_department">
                                <img src="{{ asset('assets/school.jpeg') }}" class="card-img-top" alt="...">
                            </div>
                        </a>
                        <div class="card-body">
                            <a href="{{ route('jobs.index', ['department' => $education->id]) }}" class="text-decoration-none text-dark">
                                <h4 class="">{{ $education->name_education }}</h4>
                            </a>
                            <a href="{{ route('education.edit', $education) }}" class="btn btn-success btn-xs"> <i class="fa fa-edit"></i>  Edit</a>
                            <a href="{{ route('education.destroy', $education) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/department.index.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>

<script>
    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data education?')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>
@endpush
@stop
