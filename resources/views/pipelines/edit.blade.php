@extends('adminlte::page')

@section('title', 'Edit Applicant')

@section('content_header')
<h1 class="m-0 text-dark">Edit Applicant</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Applicant</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('pipelines.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="col-md-6">
                            <!-- Job Selection -->
                            <div class="form-group">
                                <label for="job_id">Pilih Job</label>
                                <select class="form-control @error('job_id') is-invalid @enderror" id="job_id" name="job_id">
                                    <option value="">Pilih Job</option>
                                    @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" {{ old('job_id', $applicant->job_id) == $job->id ? 'selected' : '' }}>
                                        {{ $job->job_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('job_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $applicant->name) }}" placeholder="Nama Applicant" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address">Domicile</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Domicile" required>{{ old('address', $applicant->address) }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Number -->
                            <div class="form-group">
                                <label for="number">Phone Number</label>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $applicant->number) }}" placeholder="Phone Number" required>
                                @error('number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $applicant->email) }}" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- LinkedIn Profile -->
                            <div class="form-group">
                                <label for="profil_linkedin">Link Profile LinkedIn</label>
                                <input type="url" class="form-control @error('profil_linkedin') is-invalid @enderror" id="profil_linkedin" name="profil_linkedin" value="{{ old('profil_linkedin', $applicant->profil_linkedin) }}" placeholder="Link Profile LinkedIn">
                                @error('profil_linkedin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Certificates -->
                            <div class="form-group">
                                <label for="certificates">Certificate</label>
                                <input type="text" class="form-control @error('certificates') is-invalid @enderror" id="certificates" name="certificates" value="{{ old('certificates', $applicant->certificates) }}" placeholder="Certificate">
                                @error('certificates')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Pendidikan</h4>
                            <div class="form-group">
                                <select id="education" name="education" class="form-control">
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach ($educations as $education)
                                    <option value="{{ $education->id }}" {{ $applicant->education_id == $education->id ? 'selected' : '' }}>
                                        {{ $education->name_education }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Jurusan</h4>
                            <div class="form-group">
                                <select id="jurusan" name="jurusan" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ $applicant->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->name_jurusan }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Experience Period -->
                            <div class="form-group">
                                <label for="experience_period">Pengalaman Kerja (Periode)</label>
                                <input type="text" class="form-control @error('experience_period') is-invalid @enderror" id="experience_period" name="experience_period" value="{{ old('experience_period', $applicant->experience_period) }}" placeholder="Pengalaman Kerja">
                                @error('experience_period')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Photo Pass -->
                            <div class="form-group">
                                <label for="photo_pass">Unggah Foto</label>
                                <input type="file" class="form-control @error('photo_pass') is-invalid @enderror" id="photo_pass" name="photo_pass">
                                @error('photo_pass')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($applicant->photo_pass)
                                <img src="{{ asset('storage/' . $applicant->photo_pass) }}" alt="Applicant Photo" class="img-thumbnail mt-2" style="width: 100px;">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Profile -->
                            <div class="form-group">
                                <label for="profile">Profil Diri</label>
                                <textarea class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" placeholder="Profil Diri">{{ old('profile', $applicant->profile) }}</textarea>
                                @error('profile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Languages -->
                            <div class="form-group">
                                <label for="languages">Bahasa</label>
                                <textarea class="form-control @error('languages') is-invalid @enderror" id="languages" name="languages" placeholder="Bahasa yang dikuasai">{{ old('languages', $applicant->languages) }}</textarea>
                                @error('languages')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Skills -->
                            <div class="form-group">
                                <label for="skills">Keahlian</label>
                                <textarea class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" placeholder="Keahlian">{{ old('skills', $applicant->skills) }}</textarea>
                                @error('skills')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Salary Expectation -->
                            <div class="form-group">
                                <label for="salary_expectation">Ekspektasi Gaji</label>
                                <input type="number" class="form-control @error('salary_expectation') is-invalid @enderror" id="salary_expectation" name="salary_expectation" value="{{ old('salary_expectation', $applicant->salary_expectation) }}" placeholder="Ekspektasi Gaji" required>
                                @error('salary_expectation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- MBTI -->
                            <div class="form-group">
                                <label for="mbti">MBTI</label>
                                <input type="text" class="form-control @error('mbti') is-invalid @enderror" id="mbti" name="mbti" value="{{ old('mbti', $applicant->mbti) }}" placeholder="MBTI">
                                @error('mbti')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- IQ -->
                            <div class="form-group">
                                <label for="iq">IQ</label>
                                <input type="number" class="form-control @error('iq') is-invalid @enderror" id="iq" name="iq" value="{{ old('iq', $applicant->iq) }}" placeholder="IQ">
                                @error('iq')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Loop through existing work experiences -->

                        @foreach ($applicant->workExperiences as $experience)
                        <div class="work-experience-entry">
                            <h4>Pengalaman Kerja</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role[]">Jabatan</label>
                                        <input type="text" class="form-control @error('role.*') is-invalid @enderror" name="role[]" placeholder="Jabatan" value="{{ old('role.' . $loop->index, $experience->role) }}" required>
                                        @error('role.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_company[]">Nama Perusahaan</label>
                                        <input type="text" class="form-control @error('name_company.*') is-invalid @enderror" name="name_company[]" placeholder="Nama Perusahaan" value="{{ old('name_company.' . $loop->index, $experience->name_company) }}" required>
                                        @error('name_company.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desc_kerja[]">Deskripsi Pekerjaan</label>
                                        <textarea class="form-control @error('desc_kerja.*') is-invalid @enderror" name="desc_kerja[]" placeholder="Deskripsi Pekerjaan" required>{{ old('desc_kerja.' . $loop->index, $experience->desc_kerja) }}</textarea>
                                        @error('desc_kerja.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mulai[]">Tanggal Mulai</label>
                                        <input type="date" class="form-control @error('mulai.*') is-invalid @enderror" name="mulai[]" value="{{ old('mulai.' . $loop->index, $experience->mulai) }}" required>
                                        @error('mulai.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selesai[]">Tanggal Selesai</label>
                                        <input type="date" class="form-control @error('selesai.*') is-invalid @enderror" name="selesai[]" value="{{ old('selesai.' . $loop->index, $experience->selesai) }}" required>
                                        @error('selesai.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" class="btn btn-secondary add-work-experience">Tambah Pengalaman Kerja</button>


                        <!-- Button to add more work experiences -->
                

                    @foreach ($applicant->projects as $project)
                    <div class="project-entry">
                        <h4>Project</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project_name[]">Nama Project</label>
                                    <input type="text" class="form-control @error('project_name.' . $loop->index) is-invalid @enderror"
                                        name="project_name[]"
                                        placeholder="Nama Project"
                                        value="{{ old('project_name.' . $loop->index, $project->project_name) }}"
                                       >
                                    @error('project_name.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client[]">Client</label>
                                    <input type="text" class="form-control @error('client.' . $loop->index) is-invalid @enderror"
                                        name="client[]"
                                        placeholder="Client"
                                        value="{{ old('client.' . $loop->index, $project->client) }}"
                                       >
                                    @error('client.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desc_project[]">Deskripsi Project</label>
                                        <textarea class="form-control @error('desc_project.*') is-invalid @enderror" name="desc_project[]" placeholder="Deskripsi Peprojectan" >{{ old('desc_project.' . $loop->index, $project->desc_project) }}</textarea>
                                        @error('desc_project.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mulai_project[]">Tanggal Mulai</label>
                                    <input type="date" class="form-control @error('mulai_project.' . $loop->index) is-invalid @enderror"
                                        name="mulai_project[]"
                                        value="{{ old('mulai_project.' . $loop->index, $project->mulai_project) }}"
                                      >
                                    @error('mulai_project.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selesai_project[]">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('selesai_project.' . $loop->index) is-invalid @enderror"
                                        name="selesai_project[]"
                                        value="{{ old('selesai_project.' . $loop->index, $project->selesai_project) }}"
                                      >
                                    @error('selesai_project.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-secondary add-project">Tambah Project</button>


                    @foreach ($applicant->references as $reference)
                    <div class="project-entry">
                        <h4>Reference</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ref[]">Name</label>
                                    <input type="text" class="form-control @error('name_ref.' . $loop->index) is-invalid @enderror"
                                        name="name_ref[]"
                                        placeholder="Nama Project"
                                        value="{{ old('name_ref.' . $loop->index, $reference->name_ref) }}"
                                       >
                                    @error('name_ref.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone[]">phone</label>
                                    <input type="text" class="form-control @error('phone.' . $loop->index) is-invalid @enderror"
                                        name="phone[]"
                                        placeholder="phone"
                                        value="{{ old('phone.' . $loop->index, $reference->phone) }}"
                                       >
                                    @error('phone.' . $loop->index)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_ref[]">Email</label>
                                        <textarea class="form-control @error('email_ref.*') is-invalid @enderror" name="email_ref[]" placeholder="Deskripsi Peprojectan">{{ old('email_ref.' . $loop->index, $reference->email_ref) }}</textarea>
                                        @error('email_ref.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                        </div>
                    </div>
                    @endforeach


                    


                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary add-reference">Tambah Reference</button>

                        <button type="submit" class="btn btn-primary">Update Applicant</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Dynamically load Jurusan based on selected Pendidikan
        $('#education').change(function() {
            let educationId = $(this).val();
            $.ajax({
                url: '/jurusan/' + educationId,
                type: 'GET',
                success: function(data) {
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="">Pilih Jurusan</option>');
                    $.each(data, function(index, jurusan) {
                        $('#jurusan').append('<option value="' + jurusan.id + '">' + jurusan.name + '</option>');
                    });
                    // Set the previously selected jurusan if available
                    @if(isset($applicant->jurusan_id))
                    $('#jurusan').val('{{ $applicant->jurusan_id }}').change();
                    @endif
                }
            });
        });

        // Trigger the change event to pre-fill jurusan when loading the edit page
        $('#education').change();
    });
</script>


@stop