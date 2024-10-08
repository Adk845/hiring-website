<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vacancy.form.css')}}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>vacancy Form</title>
</head>
<body>

    @if($_POST)
        @dump($_POST);

    @endif
    
<div class="container">
    <div class="header">
        <h1 class="job_title">{{$jobs->job_name}}</h1>
    </div>
    <form action="{{ route('pipelines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="hidden_input">
            <input type="hidden" id="job_id" name="job_id" value="{{$jobs->id}}">
            {{-- <input type="hidden" name="status" value="Applicant"> --}}
        </div>
        <div class="form_kontainer">
            <div class="row mb-5">
                <div class="kiri col">
                    <div class="input">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Applicant" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="number">Phone Number</label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}" placeholder="Phone Number" required>
                        @error('number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="address">domicile</label>
                        <input class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" placeholder="Domicile" required>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="education" class="form-label" >Pendidikan</label>
                        <select id="education" name="education" class="form-control">
                            <option value="">Pilih Pendidikan</option>
                            @foreach ($educations as $education)
                            <option value="{{ $education->id }}">{{ $education->name_education }}</option>
                            @endforeach
                        </select>  
                        </select>
                        @error('education')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="languages">Bahasa</label>
                        <input type="text" class="form-control @error('languages') is-invalid @enderror" id="languages" name="languages" value="{{ old('languages') }}" placeholder="Bahasa yang dikuasai">
                        @error('languages')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="salary_expectation">Ekspektasi Gaji</label>
                        <input type="number" class="form-control @error('salary_expectation') is-invalid @enderror" id="salary_expectation" name="salary_expectation" value="{{ old('salary_expectation') }}" placeholder="Ekspektasi Gaji" required>
                        @error('salary_expectation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="kanan col">
                    
                    <div class="input">
                        <div class="form-group row">
                        <label for="profil_linkedin">Link Profile LinkedIn</label>
                        <input type="url" class="form-control @error('profil_linkedin') is-invalid @enderror" id="profil_linkedin" name="profil_linkedin" value="{{ old('profil_linkedin') }}" placeholder="Link Profile LinkedIn">
                        @error('profil_linkedin')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="photo_pass" class="form-label">Unggah Foto</label>
                        <input type="file" class="form-control @error('photo_pass') is-invalid @enderror" id="photo_pass" name="photo_pass" required>
                        @error('photo_pass')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="mbti">MBTI</label>
                        <input type="text" class="form-control @error('mbti') is-invalid @enderror" id="mbti" name="mbti" value="{{ old('mbti') }}" placeholder="MBTI">
                        @error('mbti')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input" style="width: 100px">
                        <label for="iq">IQ</label>
                        <input type="text" class="form-control @error('iq') is-invalid @enderror" id="iq" name="iq" value="{{ old('iq') }}" placeholder="IQ">
                        @error('iq')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="form-control">
                            <option value="">Pilih Jurusan</option>
                            <!-- Jurusan options akan diisi secara dinamis -->
                        </select>
                    </div>

                    <div class="input">
                        <label for="experience_period">Pengalaman Kerja (Periode)</label>
                        <input type="text" class="form-control @error('experience_period') is-invalid @enderror" id="experience_period" name="experience_period" value="{{ old('experience_period') }}" placeholder="Pengalaman Kerja">
                        @error('experience_period')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="profile">Profil Diri</label>
                        <textarea class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" placeholder="Profil Diri">{{ old('profile') }}</textarea>
                        @error('profile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="input skills">
                <label for="skills">Keahlian</label>
                <textarea class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" placeholder="Keahlian">{{ old('skills') }}</textarea>
                @error('skills')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                {{-- <label for="skills">Skills</label>
                <input class="trix-editor" id="skills" type="hidden" name="skills">
                <trix-editor input="skills"></trix-editor>
                @error('skills')
                <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="input achievement mb-5">
                <label for="achievement">Prestasi</label>
                <textarea class="form-control @error('achievement') is-invalid @enderror" id="achievement" name="achievement" placeholder="Prestasi">{{ old('achievement') }}</textarea>
                @error('achievement')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                {{-- <label for="achievement">Achievement</label>
                <input class="trix-editor" id="achievement" name="achievement" type="hidden">
                <trix-editor input="achievement"></trix-editor>
                @error('achievement')
                <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="input certificate">
                <label for="certificates">Certificate</label>
                <input type="text" class="form-control @error('certificates') is-invalid @enderror" id="certificates" name="certificates" value="{{ old('certificates') }}" placeholder="Certificate">
                @error('certificates')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                {{-- <label for="certificate">Certificate</label>
                <input class="trix-editor" id="certificates" type="hidden" name="certificates">
                <trix-editor input="certificates"></trix-editor>
                @error('certificate')
                <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>
            

            <div id="app" class="mt-5">
                

                <h1>Work experience</h1>
                <div  id="work_experience" class="work_experience" v-for='(experience, index) in experiences' :key='index'>
                    
                    <div class="input company_name">
                        <label class="form-label" for="name_company[]">Company Name @{{index + 1}}</label>
                        <input class="form-control" name="name_company[]" type="text">
                        @error('role_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input role_name">
                        <label class="form-label" for="role[]">Position Name @{{index + 1}}</label>
                        <input class="form-control" name="role[]" type="text">
                        @error('role.*')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input date_kontainer">
                        <div class="date work_start">
                            <label class="form-label" for="mulai[]">Start</label>
                            <input class="form-control" type="date" name="mulai[]">
                            @error('mulai.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="date work_end">
                            <label class="form-label" for="selesai[]">End</label>
                            <input class="form-control" type="date" name="selesai[]">
                            @error('selesai.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input job_description">
                        <label class="form-label" for="desc_kerja[]">Job Description @{{index + 1}}</label>
                        <input class="trix-editor" :id="'desc_kerja' + (index + 1)" name="desc_kerja[]" type="hidden">
                        <trix-editor :input="'desc_kerja' + (index + 1)"></trix-editor>
                        @error('desc_kerja')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-danger" @click="removeInput1(index)">Delete</button>
                </div>
                <button type="button" class="btn btn-secondary mb-5 ms-4" @click="addInput1" >Add</button> 
                
                <h1 style="margin-top: 30px">Project</h1>
                
                <div id="Project" class="Project" v-for='(project, index) in projects' :key='index'>
                
                    <div class="input Project_name">
                        <label class="form-label" for="project_name[]">Project Name @{{index + 1}}</label>
                        <input class="form-control" name="project_name[]" type="text">
                        @error('project_name.*')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input client_name">
                        <label class="form-label" for="client[]">Client @{{index + 1}}</label>
                        <input class="form-control" name="client[]" type="text">
                        @error('client.*')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input date_kontainer">
                        <div class="date project_start">
                            <label class="form-label" for="mulai_project[]">Start</label>
                            <input class="form-control" type="date" name="mulai_project[]">
                            @error('mulai_project.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="date project_end">
                            <label class="form-label" for="selesai_project[]">End</label>
                            <input class="form-control" type="date" name="selesai_project[]">
                            @error('selesai_project.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="input project_description">
                        <label class="form-label" for="desc_project[]">Project Description @{{index + 1}}</label>
                        <input class="trix-editor" :id="'desc_project' + (index + 1)" name="desc_project[]" type="hidden">
                        <trix-editor :input="'desc_project' + (index + 1)"></trix-editor>
                    </div>

                    <button type="button" class="btn btn-danger" @click="removeInput2(index)">Delete</button>
                </div>
                    <button type="button" class="btn btn-secondary ms-4" @click="addInput2" >Add</button> 
               
                    <h1 style="margin-top: 30px">References</h1>
                    <div class="references_kontainer">
                        <div class="references" v-for="(reference, index) in references">
                            <div class="input references_name" >
                                <label class="form-label" for="name_ref[]">Instution / Company Name</label>
                                <input class="form-control" type="text" name="name_ref[]" id="name_ref[]">
                                @error('name_ref.*')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input references_email">
                                <label for="email_ref[]" class="form-label">Email</label>
                                <input type="email" name="email_ref[]" id="email_ref[]" class="form-control">
                                @error('reference_mail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input references_number">
                                <label for="phone[]" class="form-label">Number</label>
                                <input type="text" class="form-control" name="phone[]">
                                @error('phone.*')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-danger" @click="removeInput3(index)">Delete</button>
                        </div>
                    </div>
    
                    <button type="button" class="btn btn-secondary mb-5 ms-4" @click="addInput3" >Add</button> 
                
            </div>

            <div class="submit_button mb-5 mt-5 ">
                <button class="btn btn-success btn-lg" type="submit" >Submit</button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const {createApp} = Vue
        createApp({
            data(){
                return {
                    experiences : [
                        {value: ''}
                    ],
                    projects : [
                        {value: ''}
                    ],
                    references : [
                        {value: ''}
                    ],
                }
            },
            methods: {
                addInput1() {
                    this.experiences.push({value:''});
                },
                removeInput1(index) {
                    this.experiences.splice(index, 1);
                },

                addInput2() {
                    this.projects.push({value:''});
                },
                removeInput2(index) {
                    this.projects.splice(index, 1);
                },

                addInput3() {
                    this.references.push({value:''});
                },
                removeInput3(index) {
                    this.references.splice(index, 1);
                }
            }
        }).mount('#app')


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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> {{-- library untuk text editor --}}
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> {{-- library untuk text editor --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>