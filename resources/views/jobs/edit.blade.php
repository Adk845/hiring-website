@extends('adminlte::page')

@section('title', 'Edit Job')

@section('content_header')
<h1 class="m-0 text-dark">Edit Job</h1>
@stop

@section('content')
<form action="{{ route('jobs.update', $job->id) }}" method="post">
    @csrf
    @method('PUT') <!-- Metode PUT untuk update -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Job Name -->
                            <div class="form-group">
                                <label for="job_name">Job Name</label>
                                <input type="text" class="form-control @error('job_name') is-invalid @enderror"
                                    id="job_name" placeholder="Masukkan nama pekerjaan" name="job_name"
                                    value="{{ old('job_name', $job->job_name) }}">
                                @error('job_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Work Location -->
                            <div class="form-group">
                                <label for="work_location">Work Location</label>
                                <input type="text" class="form-control @error('work_location') is-invalid @enderror"
                                    id="work_location" placeholder="Masukkan lokasi kerja" name="work_location"
                                    value="{{ old('work_location', $job->work_location) }}">
                                @error('work_location')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Minimum Salary -->
                            <div class="form-group">
                                <label for="minimum_salary">Minimum Salary</label>
                                <input type="number" class="form-control @error('minimum_salary') is-invalid @enderror"
                                    id="minimum_salary" placeholder="Gaji minimum" name="minimum_salary"
                                    value="{{ old('minimum_salary', $job->minimum_salary) }}">
                                @error('minimum_salary')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- Employment Type -->
                            <div class="form-group">
                                <label for="employment_type">Employment Type</label>
                                <select class="form-control @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type">
                                    <option value="">Pilih Tipe Pekerjaan</option>
                                    <option value="permanent" {{ old('employment_type', $job->employment_type) == 'permanent' ? 'selected' : '' }}>Permanent</option>
                                    <option value="contract" {{ old('employment_type', $job->employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                                </select>
                                @error('employment_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="form-group">
                                <label for="department">Departemen</label>
                                <select class="form-control @error('department') is-invalid @enderror"
                                    id="department" name="department" required>
                                    <option value="">Pilih Departemen</option>
                                    @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}" 
                                        {{ old('department', $job->department) == $departement->id ? 'selected' : '' }}>
                                        {{ $departement->dep_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Maximum Salary -->
                            <div class="form-group">
                                <label for="maximum_salary">Maximum Salary</label>
                                <input type="number" class="form-control @error('maximum_salary') is-invalid @enderror"
                                    id="maximum_salary" placeholder="Gaji maksimum" name="maximum_salary"
                                    value="{{ old('maximum_salary', $job->maximum_salary) }}">
                                @error('maximum_salary')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Benefit -->
                    <div class="form-group">
                        <label for="benefit">Benefit</label>
                        <textarea class="form-control @error('benefit') is-invalid @enderror" id="benefit"
                            placeholder="Masukkan benefit" name="benefit">{{ old('benefit', $job->benefit) }}</textarea>
                        @error('benefit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Responsibilities -->
                    <div class="form-group">
                        <label for="responsibilities">Responsibilities</label>
                        <textarea class="form-control @error('responsibilities') is-invalid @enderror"
                            id="responsibilities" placeholder="Tanggung jawab pekerjaan"
                            name="responsibilities">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                        @error('responsibilities')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Requirements -->
                    <div class="form-group">
                        <label for="requirements">Requirements</label>
                        <textarea class="form-control @error('requirements') is-invalid @enderror"
                            id="requirements" placeholder="Syarat pekerjaan"
                            name="requirements">{{ old('requirements', $job->requirements) }}</textarea>
                        @error('requirements')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status Published (Hidden Input) -->
                    <div class="form-group d-none">
                        <input type="hidden" name="status_published" value="0"> 
                        @error('status_published')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('jobs.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
