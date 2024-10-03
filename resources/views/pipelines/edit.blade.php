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
                    @method('PUT') <!-- Use this method for update -->
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
                                    <option value="{{ $education->id }}" {{ $applicant->education_id == $education->id ? 'selected' : '' }}>{{ $education->name_education }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Jurusan</h4>
                            <div class="form-group">
                                <select id="jurusan" name="jurusan" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    <!-- Jurusan options will be filled dynamically -->
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

                      

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Applicant</button>
                        <a href="{{ route('pipelines.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
