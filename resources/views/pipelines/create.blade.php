@extends('adminlte::page')

@section('title', 'Tambah Applicant')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Applicant</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Applicant</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('pipelines.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Job Selection -->
                            <div class="form-group">
                                <label for="job_id">Pilih Job</label>
                                <select class="form-control @error('job_id') is-invalid @enderror" id="job_id" name="job_id">
                                    <option value="">Pilih Job</option>
                                    @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" {{ old('job_id') == $job->id ? 'selected' : '' }}>
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Applicant" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address">domicile</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Domicile" required>{{ old('address') }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Number -->
                            <div class="form-group">
                                <label for="number">Phone Number</label>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}" placeholder="Phone Number" required>
                                @error('number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- LinkedIn Profile -->
                            <div class="form-group">
                                <label for="profil_linkedin">Link Profile LinkedIn</label>
                                <input type="url" class="form-control @error('profil_linkedin') is-invalid @enderror" id="profil_linkedin" name="profil_linkedin" value="{{ old('profil_linkedin') }}" placeholder="Link Profile LinkedIn">
                                @error('profil_linkedin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Certificates -->
                            <div class="form-group">
                                <label for="certificates">Certificate</label>
                                <input type="text" class="form-control @error('certificates') is-invalid @enderror" id="certificates" name="certificates" value="{{ old('certificates') }}" placeholder="Certificate">
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
                                    <option value="{{ $education->id }}">{{ $education->name_education }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Jurusan</h4>
                            <div class="form-group">
                                <select id="jurusan" name="jurusan" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    <!-- Jurusan options akan diisi secara dinamis -->
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <!-- Experience Period -->
                            <div class="form-group">
                                <label for="experience_period">Pengalaman Kerja (Periode)</label>
                                <input type="text" class="form-control @error('experience_period') is-invalid @enderror" id="experience_period" name="experience_period" value="{{ old('experience_period') }}" placeholder="Pengalaman Kerja">
                                @error('experience_period')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Photo Pass -->
                            <div class="form-group">
                                <label for="photo_pass">Unggah Foto</label>
                                <input type="file" class="form-control @error('photo_pass') is-invalid @enderror" id="photo_pass" name="photo_pass" required>
                                @error('photo_pass')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Profile -->
                            <div class="form-group">
                                <label for="profile">Profil Diri</label>
                                <textarea class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" placeholder="Profil Diri">{{ old('profile') }}</textarea>
                                @error('profile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Languages -->
                            <div class="form-group">
                                <label for="languages">Bahasa</label>
                                <textarea class="form-control @error('languages') is-invalid @enderror" id="languages" name="languages" placeholder="Bahasa yang dikuasai">{{ old('languages') }}</textarea>
                                @error('languages')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Skills -->
                            <div class="form-group">
                                <label for="skills">Keahlian</label>
                                <textarea class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" placeholder="Keahlian">{{ old('skills') }}</textarea>
                                @error('skills')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Salary Expectation -->
                            <div class="form-group">
                                <label for="salary_expectation">Ekspektasi Gaji</label>
                                <input type="number" class="form-control @error('salary_expectation') is-invalid @enderror" id="salary_expectation" name="salary_expectation" value="{{ old('salary_expectation') }}" placeholder="Ekspektasi Gaji" required>
                                @error('salary_expectation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- MBTI -->
                            <div class="form-group">
                                <label for="mbti">MBTI</label>
                                <input type="text" class="form-control @error('mbti') is-invalid @enderror" id="mbti" name="mbti" value="{{ old('mbti') }}" placeholder="MBTI">
                                @error('mbti')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- IQ -->
                            <div class="form-group">
                                <label for="iq">IQ</label>
                                <input type="text" class="form-control @error('iq') is-invalid @enderror" id="iq" name="iq" value="{{ old('iq') }}" placeholder="IQ">
                                @error('iq')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Achievements -->
                            <div class="form-group">
                                <label for="achievement">Prestasi</label>
                                <textarea class="form-control @error('achievement') is-invalid @enderror" id="achievement" name="achievement" placeholder="Prestasi">{{ old('achievement') }}</textarea>
                                @error('achievement')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Work Experience Section -->
                    <div class="work-experience-section">
                        <h4>Pengalaman Kerja</h4>
                        <div class="work-experience-entry">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role[]">Jabatan</label>
                                        <input type="text" class="form-control @error('role.*') is-invalid @enderror" name="role[]" placeholder="Jabatan" required>
                                        @error('role.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_company[]">Nama Perusahaan</label>
                                        <input type="text" class="form-control @error('name_company.*') is-invalid @enderror" name="name_company[]" placeholder="Jabatan" required>
                                        @error('name_company.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desc_kerja[]">Deskripsi Pekerjaan</label>
                                        <textarea class="form-control @error('desc_kerja.*') is-invalid @enderror" name="desc_kerja[]" placeholder="Deskripsi Pekerjaan" required></textarea>
                                        @error('desc_kerja.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mulai[]">Tanggal Mulai</label>
                                        <input type="date" class="form-control @error('mulai.*') is-invalid @enderror" name="mulai[]" required>
                                        @error('mulai.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selesai[]">Tanggal Selesai</label>
                                        <input type="date" class="form-control @error('selesai.*') is-invalid @enderror" name="selesai[]" required>
                                        @error('selesai.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary add-work-experience">Tambah Pengalaman Kerja</button>



                    <!-- Project Section -->
                    <div class="work-project-section">
                        <h4>Proyek</h4>
                        <div class="work-project-entry">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="project_name[]">Nama Project</label>
                                        <input type="text" class="form-control @error('project_name.*') is-invalid @enderror" name="project_name[]" placeholder="Jabatan">
                                        @error('project_name.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="client[]">Client</label>
                                        <input type="text" class="form-control @error('client.*') is-invalid @enderror" name="client[]" placeholder="Jabatan">
                                        @error('client.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desc_project[]">Deskripsi Project</label>
                                        <textarea class="form-control @error('desc_project.*') is-invalid @enderror" name="desc_project[]" placeholder="Deskripsi Pekerjaan"></textarea>
                                        @error('desc_project.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mulai_project[]">Tanggal mulai_project</label>
                                        <input type="date" class="form-control @error('mulai_project.*') is-invalid @enderror" name="mulai_project[]">
                                        @error('mulai_project.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selesai_project[]">Tanggal selesai_project</label>
                                        <input type="date" class="form-control @error('selesai_project.*') is-invalid @enderror" name="selesai_project[]">
                                        @error('selesai_project.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary add-project">Tambah Project</button>


                    <!-- Reference Section -->
                    <div class="work-reference-section">
                        <h4>Reference</h4>
                        <div class="work-reference-entry">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_ref[]">Nama</label>
                                        <input type="text" class="form-control @error('name_ref.*') is-invalid @enderror" name="name_ref[]" placeholder="Name Referace">
                                        @error('name_ref.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone[]">Nomor</label>
                                        <input type="text" class="form-control @error('phone.*') is-invalid @enderror" name="phone[]" placeholder="Phone Number reference" >
                                        @error('phone.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_ref[]">email_ref</label>
                                        <textarea class="form-control @error('email_ref.*') is-invalid @enderror" name="email_ref[]" placeholder="Email Reference" ></textarea>
                                        @error('email_ref.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <button type="button" class="btn btn-secondary add-reference">Tambah reference</button>


                    <button type="submit" class="btn btn-primary">Simpan Applicant</button>
                    <a href="{{ route('pipelines.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.add-work-experience').addEventListener('click', function() {
        const entry = document.querySelector('.work-experience-entry').cloneNode(true);
        entry.querySelectorAll('input, textarea').forEach(input => input.value = ''); // Clear the cloned entry
        document.querySelector('.work-experience-section').appendChild(entry);
    });
</script>

<script>
    document.querySelector('.add-project').addEventListener('click', function() {
        const entry = document.querySelector('.work-project-entry').cloneNode(true);
        entry.querySelectorAll('input, textarea').forEach(input => input.value = ''); // Clear the cloned entry
        document.querySelector('.work-project-section').appendChild(entry);
    });
</script>

<script>
    document.querySelector('.add-reference').addEventListener('click', function() {
        const entry = document.querySelector('.work-reference-entry').cloneNode(true);
        entry.querySelectorAll('input, textarea').forEach(input => input.value = ''); // Clear the cloned entry
        document.querySelector('.work-reference-section').appendChild(entry);
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#education').on('change', function () {
            var educationId = $(this).val();
            if (educationId) {
                $.ajax({
                    url: '/get-jurusan/' + educationId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#jurusan').empty();
                        $('#jurusan').append('<option value="">Pilih Jurusan</option>');
                        $.each(data, function (key, value) {
                            $('#jurusan').append('<option value="' + value.id + '">' + value.name_jurusan + '</option>');
                        });
                    }
                });
            } else {
                $('#jurusan').empty();
                $('#jurusan').append('<option value="">Pilih Jurusan</option>');
            }
        });
    });
</script>

@stop