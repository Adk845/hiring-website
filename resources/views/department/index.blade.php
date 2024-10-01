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

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="search-bar me-3">
                        <form action="{{ route('departements.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Search Department..." value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('departements.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create Department
                    </a>
                </div>

                <div class="kontainer_department mt-5">
                    @foreach($departements as $departement)
                    <div class="card" style="width: 18rem;" data-jobs="{{ json_encode($departement->jobs) }}" data-bs-toggle="modal" data-bs-target="#jobsModal">
                        <div class="image_department">
                            <img src="{{ asset('assets/marketing3.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="">{{ $departement->dep_name }}</h4>
                            <a href="{{ route('departements.edit', $departement) }}" class="fa fa-edit btn btn-success btn-xs"> Edit</a>
                            <a href="{{ route('departements.destroy', $departement) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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

<!-- Jobs Modal -->
<div class="modal fade" id="jobsModal" tabindex="-1" aria-labelledby="jobsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobsModalLabel">Jobs in Department - <span id="departmentName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody id="jobsList">
                        <!-- Jobs will be populated here -->
                    </tbody>
                </table>
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
        if (confirm('Apakah anda yakin akan menghapus data departemen?')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }

    $(document).ready(function() {
        // Handle click event on department cards
        $('.kontainer_department .card').on('click', function() {
            const jobs = $(this).data('jobs');
            const departmentName = $(this).find('h4').text(); // Assuming the department name is in an h4 tag

            // Set department name in modal
            $('#departmentName').text(departmentName);

            // Clear previous jobs
            const jobsList = $('#jobsList');
            jobsList.empty();

            // Populate jobs table
            jobs.forEach(job => {
                const row = `<tr>
                    <td>${job.job_name}</td>
                    <td>${job.work_location}</td>
                </tr>`;
                jobsList.append(row);
            });
        });
    });
</script>
@endpush
@stop
