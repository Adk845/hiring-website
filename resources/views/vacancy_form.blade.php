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
                        <label class="form-label" for="name" id="name">Nama</label>
                        <input class="form-control" type="text" name="name">
                    </div>

                    <div class="input">
                        <label class="form-label" for="email" id="email">Email</label>
                        <input class="form-control" type="text" name="email">
                    </div>

                    <div class="input">
                        <label class="form-label" for="number" id="number">Nomor Telepon</label>
                        <input class="form-control" type="text" name="number">
                    </div>

                    <div class="input">
                        <label class="form-label" for="alamat" id="alamat">Alamat</label>
                        <input class="form-control" type="text" name="alamat">
                    </div>
                </div>
                <div class="col">
                    <div class="input">
                        <label class="form-label" for="portofolio" id="portofolio">Link Portofolio</label>
                        <input class="form-control" type="text" name="portofolio">
                    </div>

                    <div class="input">
                        <label class="form-label" for="profil_linkdin" id="profil_linkdin">Link Profil Linkdin</label>
                        <input class="form-control" type="text" name="profil_linkdin">
                    </div>

                    <div class="input">
                        <label class="form-label" for="photo_pass" id="photo_pass">Photo</label>
                        <input class="form-control" type="file" name="photo_pass">
                    </div>

                   

                </div>
            </div>

            <div id="app">
                <div class="mb-4" id="certification" v-for='(certification, index) in certifications' :key='index'>
                    
                    <div class="certificate">
                        <label class="form-label" :for="'certificate_name_' + (index + 1)">Sertifikasi @{{index + 1}}</label>
                        <input class="form-control" :name="'certificate_name_' + (index + 1)" type="text">
                    </div>
                    <div class="date">
                        <label class="form-label" for="date_certification ">Tanggal Terbit</label>
                        <input class="form-control" type="date" name="date_certification">
                    </div>
                    <button type="button" class="btn btn-danger" @click="removeInput1(index)">Hapus Sertifikasi</button>
                </div>
                <button type="button" class="btn btn-secondary" @click="addInput1" >Tambah Sertifikasi</button>


                
            </div>
        </div>
    </form>
</div>

    <script>
        const {createApp} = Vue
        createApp({
            data(){
                return {
                    certifications : [
                        {value: ''}
                    ],
                    experience : [
                        {value: ''}
                    ],
                }
            },
            methods: {
                addInput1() {
                    this.certifications.push({value:''});
                },
                removeInput1(index) {
                    this.certifications.splice(index, 1);
                },

                addInput2() {
                    this.certifications.push({value:''});
                },
                removeInput2(index) {
                    this.certifications.splice(index, 1);
                }
            }
        }).mount('#app')
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>