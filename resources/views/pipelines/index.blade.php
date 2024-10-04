@extends('adminlte::page')

@section('title', 'List Applicants')

@section('content_header')
<h1 class="m-0 text-dark">List Applicants</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="search-bar me-3">
                        <form action="{{ route('pipelines.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Search Applicant..." value="{{ request()->get('search') }}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('pipelines.create') }}" class="btn btn-primary mb-2">
                        <i class="fa fa-plus"></i> Create Applicant
                    </a>
                </div>

                <table class="table table-hover table-bordered table-striped" id="example2">
                    <thead>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Work Location</th>
                            <th>Phone</th>
                            <th>Move Stage</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applicants as $key => $applicant)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div style="display: flex; align-items: center; cursor: pointer;" onclick="showApplicantInfo({{ json_encode($applicant) }})">
                                    @if($applicant->photo_pass)
                                    <img src="{{ asset('storage/' . $applicant->photo_pass) }}" alt="Applicant Photo" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                    @else
                                    <span style="width: 50px; height: 50px; display: inline-block; background-color: #f0f0f0; margin-right: 10px; border-radius: 50%;"></span>
                                    @endif
                                    <span>{{ $applicant->name }}</span>
                                </div>
                            </td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ optional($applicant->job)->workLocation->location }} - <span> {{($applicant->job)->spesifikasi}}</span>
                            </td>
                            <td>{{ $applicant->number }}</td>
                            <td class="pipeline_stage">
                                <div>
                                    <form action="{{ route('applicants.updateStatus', $applicant->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <div class="dropdown">
                                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst($applicant->status) ?: 'Pilih Status' }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <button type="submit" name="status" value="applied" class="dropdown-item">Applicant</button>
                                                <button type="submit" name="status" value="interview" class="dropdown-item">Interview</button>
                                                <button type="submit" name="status" value="offer" class="dropdown-item">Offer</button>
                                                <button type="submit" name="status" value="accepted" class="dropdown-item">Accepted</button>
                                                <button type="submit" name="status" value="rejected" class="dropdown-item">Rejected</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- Edit button -->
                                        <a href="{{ route('pipelines.edit', $applicant->id) }}" class="dropdown-item">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <!-- Delete button -->
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); 
                         if (confirm('Are you sure you want to delete this item?')) {
                             document.getElementById('delete-form-{{ $applicant->id }}').submit();
                         }">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>

                                        <!-- Hidden delete form -->
                                        <form id="delete-form-{{ $applicant->id }}" action="{{ route('pipelines.destroy', $applicant) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for applicant information -->
<div class="modal fade" id="applicantInfoModal" tabindex="-1" role="dialog" aria-labelledby="applicantInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2890a7;">
                <h5 class="modal-title" id="applicantInfoModalLabel">Applicant Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="applicant-photo" src="" alt="Applicant Photo" class="img-fluid rounded" style="width: 200px; height: 300px;">
                    </div>
                    <div class="col-md-8">
                        <h5 id="applicant-name"></h5>
                        <p><strong>Email:</strong> <span id="applicant-email"></span></p>
                        <p><strong>Phone:</strong> <span id="applicant-number"></span></p>
                        <p><strong>Address:</strong> <span id="applicant-address"></span></p>
                        <p><strong>Job:</strong> <span id="applicant-job"></span></p>
                        <p><strong>Skills:</strong> <span id="applicant-skills"></span></p>
                        <p><strong>Salary Expectation:</strong> Rp.<span id="applicant-salary"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="download-cv" href="#" class="btn btn-primary">CV</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

<link rel="stylesheet" href="{{ asset('css/applicant.index.css') }}">

@push('js')
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "responsive": true,
        });
    });

    function showApplicantInfo(applicant) {
        console.log(applicant); // Debugging to check if data is passed correctly

        // Populate modal with applicant data
        $('#applicant-photo').attr('src', applicant.photo_pass ? "{{ asset('storage/') }}/" + applicant.photo_pass : 'https://via.placeholder.com/100');
        $('#applicant-name').text(applicant.name);
        $('#applicant-email').text(applicant.email);
        $('#applicant-number').text(applicant.number);
        $('#applicant-address').text(applicant.address);
        $('#applicant-job').text(applicant.job ? applicant.job.job_name : 'N/A');
        $('#applicant-skills').text(applicant.skills ? applicant.skills : 'N/A');
        $('#applicant-salary').text(applicant.salary_expectation);

        // Update CV download link dynamically
        $('#download-cv').attr('href', "{{ url('/pipelines') }}/" + applicant.id + "/pdf");

        // Show the modal
        $('#applicantInfoModal').modal('show');
    }
</script>
@endpush