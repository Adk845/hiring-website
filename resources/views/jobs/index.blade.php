@extends('adminlte::page')

@section('title', 'Daftar Jobs')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Jobs</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">Tambah Job</a>
            </div>

            <div class="card-body">
                <div class="row">
                    @forelse ($jobs as $job)
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="row mt-3 text-center">
                                <div class="col">
                                    <h5 class="card-title job-name" data-toggle="modal" data-target="#jobModal" data-job="{{ json_encode($job) }}">{{ $job->job_name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted job-location" data-toggle="modal" data-target="#jobModal" data-job="{{ json_encode($job) }}">{{ $job->work_location }}</h6>
                                </div>
                                <div class="col">
                                    <p class="card-text">
                                        <span class="font-weight-bold">{{ $job->applicants->count() }}</span><br>
                                        <small>Applicant</small>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text">
                                        <span class="font-weight-bold">{{ $job->applicants->where('status', 'interview')->count() }}</span><br>
                                        <small>Interview</small>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text">
                                        <span class="font-weight-bold">{{ $job->applicants->where('status', 'offer')->count() }}</span><br>
                                        <small>Offer</small>
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text">
                                        <span class="font-weight-bold">{{ $job->applicants->where('status', 'accepted')->count() }}</span><br>
                                        <small>Accept</small>
                                    </p>
                                </div>

                                <div class="col">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus job ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">Belum ada data job yang tersedia.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Job Details Modal -->
<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobModalLabel">Job Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="modal-job-name"></h5>
                <p><strong>Location:</strong> <span id="modal-job-location"></span></p>
                <p><strong>Minimum Salary:</strong> <span id="modal-minimum-salary"></span></p>
                <p><strong>Maximum Salary:</strong> <span id="modal-maximum-salary"></span></p>
                <p><strong>Employment Type:</strong> <span id="modal-employment-type"></span></p>
                <p><strong>Benefit:</strong> <span id="modal-benefit"></span></p>
                <p><strong>Responsibilities:</strong> <span id="modal-responsibilities"></span></p>
                <p><strong>Requirements:</strong> <span id="modal-requirements"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
<script>
    $(document).ready(function() {
        $('.job-name, .job-location').on('click', function() {
            // Get job data from the clicked element
            var job = $(this).data('job');
            
            // Populate the modal with job details
            $('#modal-job-name').text(job.job_name);
            $('#modal-job-location').text(job.work_location);
            $('#modal-minimum-salary').text(job.minimum_salary);
            $('#modal-maximum-salary').text(job.maximum_salary);
            $('#modal-employment-type').text(job.employment_type);
            $('#modal-benefit').text(job.benefit);
            $('#modal-responsibilities').text(job.responsibilities);
            $('#modal-requirements').text(job.requirements);
        });
    });
</script>
@endpush
