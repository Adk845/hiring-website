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
                            <!-- <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">

                                   
                                </div> -->

                                <!-- Rincian Poin -->
                                <div class="row mt-3 text-center">
                                    <div class="col">
                                        <h5 class="card-title">{{ $job->job_name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $job->work_location }}</h6>
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

                                    <div  class="col">
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
@stop