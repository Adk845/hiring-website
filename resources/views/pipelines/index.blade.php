@extends('adminlte::page')

@section('title', 'List Applicants')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <b> List Applicants
            @if(isset($jobTitle) && isset($stageName))
            - {{ $jobTitle }} ({{ $stageName }})
            @endif
        </b>
    </h1>




    <!-- Filter Status Stage -->
    <!-- Only show the status boxes if no job_id is provided -->
    @if (!$request->has('job_id'))
    <div class="status-boxes">
        <a href="{{ route('pipelines.index', ['stage' => 'all', 'education' => $request->get('education')]) }}" class="status-box status-all {{ $request->get('stage') == 'all' ? 'active' : '' }}">
            <small>All</small>
        </a>
        <a href="{{ route('pipelines.index', ['status' => 'applied', 'education' => $request->get('education')]) }}" class="status-box status-applied {{ $request->get('status') == 'applied' ? 'active' : '' }}">
            <p>{{ $statusCounts['applied'] }}</p>
            <small>Applied</small>
        </a>
        <a href="{{ route('pipelines.index', ['status' => 'interview', 'education' => $request->get('education')]) }}" class="status-box status-interview {{ $request->get('status') == 'interview' ? 'active' : '' }}">
            <p>{{ $statusCounts['interview'] }}</p>
            <small>Interview</small>
        </a>
        <a href="{{ route('pipelines.index', ['status' => 'offer', 'education' => $request->get('education')]) }}" class="status-box status-offer {{ $request->get('status') == 'offer' ? 'active' : '' }}">
            <p>{{ $statusCounts['offer'] }}</p>
            <small>Offer</small>
        </a>
        <a href="{{ route('pipelines.index', ['status' => 'accepted', 'education' => $request->get('education')]) }}" class="status-box status-accepted {{ $request->get('status') == 'accepted' ? 'active' : '' }}">
            <p>{{ $statusCounts['accepted'] }}</p>
            <small>Accepted</small>
        </a>
        <a href="{{ route('pipelines.index', ['status' => 'bankcv', 'education' => $request->get('education')]) }}" class="status-box status-accepted {{ $request->get('status') == 'bankcv' ? 'active' : '' }}">
            <p>{{ $statusCounts['bankcv'] }}</p>
            <small>Bank CV</small>
        </a>
    </div>
    @endif

</div>
@stop



@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">


                <!-- Search bar and filters -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="search-bar me-3">
                        <form action="{{ route('pipelines.index') }}" method="GET" class="d-flex align-items-center flex-wrap gap-3">

                            <!-- Filter Education and Major -->
                            <div class="d-flex align-items-center">
                                <!-- Filter by Education -->
                                <select name="education" class="form-select me-2" id="education-dropdown">
                                    <option value="">Edu</option>
                                    @foreach($educations as $education)
                                    <option value="{{ $education->id }}" {{ $request->get('education') == $education->id ? 'selected' : '' }}>
                                        {{ $education->name_education }}
                                    </option>
                                    @endforeach
                                </select>

                                <!-- Filter by Jurusan (Major) -->
                                <select name="jurusan" class="form-select me-2" id="jurusan-dropdown">
                                    <option value="">Major</option>
                                    @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" data-education-id="{{ $jurusan->education_id }}" {{ $request->get('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->name_jurusan }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter by Recommendation -->
                            <div class="d-flex align-items-center">
                                <select name="recommendation" class="form-select me-2" id="recommendation-dropdown">
                                    <option value="">Recommendation</option>
                                    <option value="recommended" {{ $request->get('recommendation') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                                    <option value="not_recommended" {{ $request->get('recommendation') == 'not_recommended' ? 'selected' : '' }}>Not Recommended</option>
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="d-flex align-items-center">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ $request->get('search') }}" aria-label="Search Applicant">
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                    </div>
                    <div style="display: flex; align-items: center;">



                        <a href="{{ route('pipelines.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create Applicant
                        </a>
                    </div>




                </div>
                <div class="table-wrapper">
                    <table class="table table-hover table-bordered table-striped" id="example2">
                        <thead>
                            <tr class="blue-gradient">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Education</th>
                                <th>Job</th>


                                <th>Move Stage</th>
                                <th></th>
                                <th>Action</th>
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
                                <td>{{ $applicant->education->name_education }} - {{ $applicant->jurusan->name_jurusan }}</td>
                                <td>{{ $applicant->job->job_name }}</td>


                                <td class="pipeline_stage">
                                    <div>
                                        <form action="{{ route('applicants.updateStatus', $applicant->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <div class="dropdown">
                                                <button class="btn btn-white dropdown-toggle btn-fixed-width" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ ucfirst($applicant->status) ?: 'Pilih Status' }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <button type="submit" name="status" value="applied" class="dropdown-item">Applicant</button>
                                                    <button type="submit" name="status" value="interview" class="dropdown-item">Interview</button>
                                                    <button type="submit" name="status" value="offer" class="dropdown-item">Offer</button>
                                                    <button type="submit" name="status" value="accepted" class="dropdown-item">Accepted</button>
                                                    <!-- <button type="submit" name="status" value="rejected" class="dropdown-item">Rejected</button> -->
                                                    <button type="submit" name="status" value="bankcv" class="dropdown-item">Bank CV</button>

                                                </div>
                                <td>
                                    <div class="recommendation-remark" onclick="toggleDropdown(this)">
                                        <span class="selected-option"
                                            style="color: white; background-color: <?php echo $applicant->recommendation_status === 'recommended' ? 'green' : 'orange'; ?>;">
                                            <?php echo ucfirst(str_replace('_', ' ', $applicant->recommendation_status)); ?>
                                        </span>
                                        <div class="options" style="display: none;">
                                            <div class="option" data-value="recommended"
                                                onclick="updateRecommendation(this, <?php echo $applicant->id; ?>)"
                                                style="background-color: green; color: white;">Recommended</div>
                                            <div class="option" data-value="not_recommended"
                                                onclick="updateRecommendation(this, <?php echo $applicant->id; ?>)"
                                                style="background-color: orange; color: white;">Not Recommended</div>
                                        </div>
                                    </div>
                                </td>



                                </form>
                </div>
                </td>
                <td>
                    <div class="action-icons">
                        <!-- Edit button -->
                        <a href="{{ route('pipelines.edit', $applicant->id) }}" class="action-icon" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>

                        <!-- Delete button -->
                        <a href="#" class="action-icon"
                            onclick="event.preventDefault(); 
            if (confirm('Are you sure you want to delete this item?')) {
                document.getElementById('delete-form-{{ $applicant->id }}').submit();
            }" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>

                        <!-- Hidden delete form -->
                        <form id="delete-form-{{ $applicant->id }}" action="{{ route('pipelines.destroy', $applicant) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
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
</div>
<!-- Modal for applicant information -->
<div class="modal fade" id="applicantInfoModal" tabindex="-1" role="dialog" aria-labelledby="applicantInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #007bff, #0056b3);">
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
                        <!-- <p><strong>Skills:</strong> <span id="applicant-skills"></span></p> -->
                        <p><strong>Salary Expectation:</strong> Rp.<span id="applicant-salary"></span></p>
                        <textarea id="applicant-notes" placeholder="Add notes here..." style="width: 100%; height: 100px;" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save-notes-button" onclick="saveNotes()" class="btn btn-primary">Save Notes</button>
                <button id="edit-notes-button" onclick="editNotes()" class="btn btn-secondary" style="display: none;">Edit</button>
                <button onclick="deleteNotes()" class="btn btn-danger">Delete Notes</button>
                <a id="download-cv" href="#" class="btn btn-success">Download CV</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/applicant.index.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('js')
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "responsive": true,
        });

        $('#applicantInfoModal').on('hidden.bs.modal', function() {
            $('#applicant-notes').prop('disabled', true);
            $('#save-notes-button').hide();
            $('#edit-notes-button').show();
        });
    });

    let currentApplicantId = null;

    function showApplicantInfo(applicant) {
        $('#applicant-photo').attr('src', applicant.photo_pass ? "{{ asset('storage/') }}/" + applicant.photo_pass : 'https://via.placeholder.com/100');
        $('#applicant-name').text(applicant.name);
        $('#applicant-email').text(applicant.email);
        $('#applicant-number').text(applicant.number);
        $('#applicant-address').text(applicant.address);
        $('#applicant-job').text(applicant.job ? applicant.job.job_name : 'N/A');
        $('#applicant-salary').text(applicant.salary_expectation);
        $('#download-cv').attr('href', "{{ url('/pipelines') }}/" + applicant.id + "/pdf");

        currentApplicantId = applicant.id;

        // AJAX request to get saved notes
        // $.ajax({
        //     url: "/api/getnotes/" + currentApplicantId,
        //     type: "GET",
        //     success: function(response) {
        //         const savedNotes = response.notes;
        //         const notes = response.notes;
        //         console.log(notes);
        //         $('#applicant-notes').val(savedNotes ? savedNotes : '');

        //         if (savedNotes) {
        //             $('#applicant-notes').prop('disabled', true);
        //             $('#save-notes-button').hide();
        //             $('#edit-notes-button').show();
        //         } else {
        //             $('#applicant-notes').prop('disabled', false);
        //             $('#save-notes-button').show();
        //             $('#edit-notes-button').hide();
        //         }
        //     },
        //     error: function(xhr) {
        //         console.error(xhr.responseText); // Log the error response for debugging
        //         alert('Error loading notes: ' + xhr.statusText);


        //     }
        // });

        fetch('/getnotes/' + currentApplicantId)
            .then(response => {
                if (!response.ok) {
                    // throw new Error('ada kesalahan');
                    console.log('error')
                }
                return response.json();
            })
            .then(data => {
                const savedNotes = data.notes;
                const notes = data.notes;
                console.log(notes);
                $('#applicant-notes').val(savedNotes ? savedNotes : '');

                if (savedNotes) {
                    $('#applicant-notes').prop('disabled', true);
                    $('#save-notes-button').hide();
                    $('#edit-notes-button').show();
                } else {
                    $('#applicant-notes').prop('disabled', false);
                    $('#save-notes-button').show();
                    $('#edit-notes-button').hide();
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

        $('#applicantInfoModal').modal('show');
    }



    function saveNotes() {
        if (currentApplicantId) {
            const notes = $('#applicant-notes').val();

            $.ajax({
                url: "{{ route('save.notes') }}",
                type: "POST",
                data: {
                    applicant_id: currentApplicantId,
                    notes: notes,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    $('#applicant-notes').prop('disabled', true);
                    $('#save-notes-button').hide();
                    $('#edit-notes-button').show();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log the error response for debugging
                    alert('Error saving notes: ' + xhr.statusText);
                }
            });

        }
    }

    function editNotes() {
        $('#applicant-notes').prop('disabled', false);
        $('#edit-notes-button').hide();
        $('#save-notes-button').show();
    }

    function deleteNotes() {
        if (currentApplicantId) {
            $.ajax({
                url: "{{ route('delete.notes') }}",
                type: "POST",
                data: {
                    applicant_id: currentApplicantId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);

                    $('#applicant-notes').val('');
                    $('#applicant-notes').prop('disabled', false);
                    $('#save-notes-button').show();
                    $('#edit-notes-button').hide();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log the error response for debugging
                    alert('Error deleting notes: ' + xhr.statusText);
                }
            });
        }
    }
</script>



<script>
    $(document).ready(function() {

        $('#education-dropdown').change(function() {
            var selectedEducationId = $(this).val();


            $('#jurusan-dropdown option').each(function() {
                if ($(this).data('education-id') == selectedEducationId || selectedEducationId == '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });


            if (selectedEducationId == '') {
                $('#jurusan-dropdown').val('').change();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('.filter-stage').click(function() {
            var selectedStage = $(this).data('stage');


            $('.applicant-card').each(function() {
                var applicantStage = $(this).data('stage');

                if (selectedStage === '' || applicantStage === selectedStage) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script>
    function updateRecommendation(selectElement) {
        var recommendation = selectElement.value; // Ambil nilai dropdown
        var applicantId = selectElement.getAttribute('data-id'); // Ambil ID applicant dari atribut data

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '{{ route("applicant.recommend") }}', // Gunakan rute yang benar
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                recommendation_status: recommendation, // Sesuaikan dengan parameter yang diharapkan di controller
                id: applicantId // Kirim ID applicant
            },
            success: function(response) {
                console.log(response.message); // Menampilkan pesan sukses di konsol
                updateDropdownColor(selectElement); // Ubah warna dropdown sesuai pilihan
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Tangani error
            }
        });
    }

    function updateDropdownColor(selectElement) {
        if (selectElement.value === 'recommended') {
            selectElement.style.backgroundColor = 'green'; // Mengubah warna latar belakang menjadi hijau
            selectElement.style.color = 'white'; // Mengubah warna teks menjadi putih
        } else {
            selectElement.style.backgroundColor = 'orange'; // Mengubah warna latar belakang menjadi oranye
            selectElement.style.color = 'white'; // Mengubah warna teks menjadi putih
        }

        selectElement.style.transition = 'background-color 0.3s'; // Menambahkan efek transisi
    }
</script>

<script>
    function toggleDropdown(element) {
        const options = element.querySelector('.options');
        options.style.display = options.style.display === 'none' ? 'block' : 'none'; // Toggle display
    }

    function updateRecommendation(optionElement, applicantId) {
        const recommendation = optionElement.getAttribute('data-value');

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '{{ route("applicant.recommend") }}', // Gunakan rute yang benar
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                recommendation_status: recommendation, // Sesuaikan dengan parameter yang diharapkan di controller
                id: applicantId // Kirim ID applicant
            },
            success: function(response) {
                console.log(response.message); // Menampilkan pesan sukses di konsol
                updateRemarkDisplay(optionElement, recommendation); // Update tampilan remark
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Tangani error
            }
        });
    }

    function updateRemarkDisplay(optionElement, recommendation) {
        const remark = optionElement.closest('.recommendation-remark');
        const selectedOption = remark.querySelector('.selected-option');

        selectedOption.innerText = optionElement.innerText; // Update teks yang ditampilkan
        selectedOption.style.backgroundColor = recommendation === 'recommended' ? 'green' : 'orange'; // Update warna latar belakang
        selectedOption.style.color = 'white'; // Update warna teks
        remark.querySelector('.options').style.display = 'none'; // Sembunyikan opsi setelah memilih
    }
</script>

<script>
    function filterNotRecommended() {
        const applicants = document.querySelectorAll('.applicant');
        applicants.forEach(applicant => {
            if (applicant.getAttribute('data-status') === 'not_recommended') {
                applicant.style.display = 'block'; // Tampilkan yang tidak direkomendasikan
            } else {
                applicant.style.display = 'none'; // Sembunyikan yang direkomendasikan
            }
        });
    }

    function filterRecommended() {
        const applicants = document.querySelectorAll('.applicant');
        applicants.forEach(applicant => {
            if (applicant.getAttribute('data-status') === 'recommended') {
                applicant.style.display = 'block'; // Tampilkan yang direkomendasikan
            } else {
                applicant.style.display = 'none'; // Sembunyikan yang tidak direkomendasikan
            }
        });
    }
</script>



@endpush