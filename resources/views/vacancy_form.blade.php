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

<div class="container">
    <form action="" @submit.prevent="submitForm">
        <div class="form_kontainer">
            <div class="row mb-5">
                <div class="col">
                    <div class="input">
                        <label class="form-label" for="name" id="name">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Ex. Andrew Martin">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="email" id="email">Email</label>
                        <input class="form-control" type="text" name="email" placeholder="Ex. andrew@gmail.com">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="number" id="number">Telephone Number</label>
                        <input class="form-control" type="text" name="number" placeholder="0857xxxx">
                        @error('number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="address" id="address">Domicile</label>
                        <input class="form-control" type="text" name="address" placeholder="Ex. Jakarta">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" >Education</label>
                        <select class="form-select" name="education" id="education" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>                 
                        </select>
                        @error('education')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="languages" id="languages">Languages Skills</label>
                        <input class="form-control" type="text" name="languages" placeholder="Ex .English, German, Russian">
                        @error('languages')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="salary_expectation" id="salary_expectation">Salary Expectations</label>
                        <input class="form-control" type="number" name="salary_expectation" placeholder="">
                        @error('salary_expectation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col">
                    
                    <div class="input">
                        <label class="form-label" for="profil_linkdin" id="profil_linkdin">Link Profil Linkdin</label>
                        <input class="form-control" type="text" name="profil_linkdin" placeholder="https://linkdin/....">
                        @error('profil_linkdin')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="photo_pass" id="photo_pass">Photo</label>
                        <input class="form-control" type="file" name="photo_pass">
                        @error('photo_pass')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" >MBTI Test</label>
                        <select class="form-select" name="mbti" id="mbti" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="ISTJ">ISTJ</option>
                            <option value="ISTP">ISTP</option>
                            <option value="ISFJ">ISFJ</option>
                            <option value="ISFP">ISFP</option>
                            <option value="INFJ">INFJ</option>
                            <option value="INFP">INFP</option>
                            <option value="INTJ">INTJ</option>
                            <option value="INTP">INTP</option>
                            <option value="ESTP">ESTP</option>
                            <option value="ESTJ">ESTJ</option>
                            <option value="ESFP">ESFP</option>
                            <option value="ENFJ">ENFJ</option>
                            <option value="ESFJ">ESFJ</option>
                            <option value="ENFP">ENFP</option>
                            <option value="ENTJ">ENTJ</option>
                            <option value="ENTP">ENTP</option>                          
                        </select>
                        @error('mbti')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input" style="width: 100px">
                        <label class="form-label" for="iq" id="iq">IQ</label>
                        <input class="form-control" type="number" name="iq">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" >Major</label>
                        <select class="form-select" name="jurusan" id="jurusan" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="IT">IT</option>
                            <option value="HSE">HSE</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Management">Management</option>
                            <option value="Business">Business</option>
                            <option value="Mechanical">Mechanical</option>                                                
                        </select>
                        @error('jurusan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input">
                        <label class="form-label" for="exp_period" id="exp_period">Work Experience Period</label>
                        <input class="form-control" type="number" name="exp_period" placeholder="Years">
                        @error('exp_period')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="input skills">
                <label for="skills">Skills</label>
                <input class="trix-editor" id="skills" type="hidden" name="skills">
                <trix-editor input="skills"></trix-editor>
                @error('skills')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input achievement mb-5">
                <label for="achievement">Achievement</label>
                <input class="trix-editor" id="achievement" type="hidden" name="achievement">
                <trix-editor input="achievement"></trix-editor>
                @error('achievement')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input certificate">
                <label for="certificate">Certificate</label>
                <input class="trix-editor" id="certificate" type="hidden" name="certificate">
                <trix-editor input="certificate"></trix-editor>
                @error('certificate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            

            <div id="app">

                <div class="references" v-for="(reference, index) in references">
                    <div class="input references_name" >
                        <label class="form-label" for="references_name">Instution / Company Name</label>
                        <input class="form-control" type="text" name="references_name" id="references_name">
                    </div>
                    <div class="input references_email">
                        <label for="references_email" class="form-label">Email</label>
                        <input type="email" name="references_email" id="references_email" class="form-control">
                    </div>
                    <div class="input references_number">
                        <label for="references_number" class="form-label">Number</label>
                        <input type="text" class="form-control">
                    </div>
                    <button type="button" class="btn btn-danger" @click="removeInput3(index)">Hapus</button>
                    <hr>
                </div>

                <button type="button" class="btn btn-secondary" @click="addInput3" >Tambah</button> 


                <h1>Work experience</h1>
                <div class="mb-4" id="work_experience" class="work_experience" v-for='(experience, index) in experiences' :key='index'>
                    
                    <div class="input company_name">
                        <label class="form-label" :for="'company_name_' + (index + 1)">Company Name @{{index + 1}}</label>
                        <input class="form-control" :name="'company_name_' + (index + 1)" type="text">
                    </div>
                    <div class="input role_name">
                        <label class="form-label" :for="'role_name_' + (index + 1)">Position Name @{{index + 1}}</label>
                        <input class="form-control" :name="'role_name_' + (index + 1)" type="text">
                    </div>

                    <div class="input date_kontainer">
                        <div class="date work_start">
                            <label class="form-label" :for="'work_start' + (index + 1)">Start</label>
                            <input class="form-control" type="date" :name="'work_start' + (index + 1)">
                        </div>
    
                        <div class="date work_end">
                            <label class="form-label" :for="'work_end' + (index + 1)">End</label>
                            <input class="form-control" type="date" :name="'work_end' + (index + 1)">
                        </div>
                    </div>

                    <div class="input job_description">
                        <label class="form-label" :for="'job_description_' + (index + 1)">Job Description @{{index + 1}}</label>
                        <input class="trix-editor" :id="'job_description_' + (index + 1)" :name="'job_description_' + (index + 1)" type="hidden">
                        <trix-editor input="job_description"></trix-editor>
                        @error('job_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-danger" @click="removeInput1(index)">Hapus</button>
                    <hr>
                </div>
                <button type="button" class="btn btn-secondary mb-5" @click="addInput1" >Tambah</button> 
                
                <h1 style="margin-top: 30px">Project</h1>
                <div class="Project">
                    <div class="mb-4" id="Project" class="Project" v-for='(project, index) in projects' :key='index'>
                    
                        <div class="input Project">
                            <label class="form-label" :for="'Project_name' + (index + 1)">Project Name @{{index + 1}}</label>
                            <input class="form-control" :name="'Project_name' + (index + 1)" type="text">
                        </div>
                        <div class="input client_name">
                            <label class="form-label" :for="'client_name_' + (index + 1)">Client @{{index + 1}}</label>
                            <input class="form-control" :name="'client_name_' + (index + 1)" type="text">
                        </div>
    
                        <div class="input date_kontainer">
                            <div class="date project_start">
                                <label class="form-label" :for="'project_start' + (index + 1)">Start</label>
                                <input class="form-control" type="date" :name="'project_start' + (index + 1)">
                            </div>
        
                            <div class="date project_end">
                                <label class="form-label" :for="'project_end' + (index + 1)">End</label>
                                <input class="form-control" type="date" :name="'project_end' + (index + 1)">
                            </div>
                        </div>
    
                        <div class="input project_description">
                            <label class="form-label" :for="'project_description_' + (index + 1)">Project Description @{{index + 1}}</label>
                            <input class="trix-editor" :id="'project_description_' + (index + 1)" :name="'project_description_' + (index + 1)" type="hidden">
                            <trix-editor input="project_description"></trix-editor>
                        </div>
    
                        <button type="button" class="btn btn-danger" @click="removeInput2(index)">Hapus</button>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-secondary" @click="addInput2" >Tambah</button> 
                </div>

                
            </div>
        </div>
    </form>
</div>

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
    </script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> {{-- library untuk text editor --}}
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> {{-- library untuk text editor --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>