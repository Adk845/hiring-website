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
                        @method('PUT') <!-- Method Spoofing for PUT request -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Job Selection -->
                                <div class="form-group">
                                    <label for="job_id">Pilih Job</label>
                                    <select class="form-control @error('job_id') is-invalid @enderror" id="job_id" name="job_id">
                                        <option value="">Pilih Job</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}" {{ $applicant->job_id == $job->id ? 'selected' : '' }}>
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
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $applicant->name) }}" placeholder="Nama Applicant">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Alamat Applicant">{{ old('address', $applicant->address) }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Number -->
                                <div class="form-group">
                                    <label for="number">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $applicant->number) }}" placeholder="Nomor Telepon">
                                    @error('number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $applicant->email) }}" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- LinkedIn Profile -->
                                <div class="form-group">
                                    <label for="profil_linkedin">Link Profil LinkedIn</label>
                                    <input type="url" class="form-control @error('profil_linkedin') is-invalid @enderror" id="profil_linkedin" name="profil_linkedin" value="{{ old('profil_linkedin', $applicant->profil_linkedin) }}" placeholder="Link Profil LinkedIn">
                                    @error('profil_linkedin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Portfolio -->
                                <div class="form-group">
                                    <label for="portfolio">Portfolio</label>
                                    <input type="url" class="form-control @error('portfolio') is-invalid @enderror" id="portfolio" name="portfolio" value="{{ old('portfolio', $applicant->portfolio) }}" placeholder="Link Portfolio">
                                    @error('portfolio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Certificates -->
                                <div class="form-group">
                                    <label for="certificates">Sertifikat</label>
                                    <input type="text" class="form-control @error('certificates') is-invalid @enderror" id="certificates" name="certificates" value="{{ old('certificates', $applicant->certificates) }}" placeholder="Sertifikat yang dimiliki">
                                    @error('certificates')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Education -->
                                <div class="form-group">
                                    <label for="education">Pendidikan</label>
                                    <input type="text" class="form-control @error('education') is-invalid @enderror" id="education" name="education" value="{{ old('education', $applicant->education) }}" placeholder="Pendidikan">
                                    @error('education')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Experience -->
                                <div class="form-group">
                                    <label for="experience">Pengalaman Kerja</label>
                                    <input type="text" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience', $applicant->experience) }}" placeholder="Pengalaman Kerja">
                                    @error('experience')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Photo Pass -->
                                <div class="form-group">
                                    <label for="photo_pass">Unggah Foto</label>
                                    <input type="file" class="form-control @error('photo_pass') is-invalid @enderror" id="photo_pass" name="photo_pass">
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                    @error('photo_pass')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                    <input type="number" class="form-control @error('salary_expectation') is-invalid @enderror" id="salary_expectation" name="salary_expectation" value="{{ old('salary_expectation', $applicant->salary_expectation) }}" placeholder="Ekspektasi Gaji">
                                    @error('salary_expectation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Applicant</button>
                        <a href="{{ route('pipelines.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
