<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vacancy.index.css')}}">
    <title>vacancy</title>
</head>
<body>
    

<div class="container mt-5">
    <div class="header p-4">
        <div>
            <img src="{{asset('assets/isolutions.png')}}" width="300px" alt="">
            <div class="title mt-4 mb-4 "><h1>Open Hiring</h1></div>
        </div>
    </div>
    
    <div class="kontainer_vacancy">

        <div class="top mb-5"> 
            <div class="title mt-4 d-flex justify-content-between">
                <h1>{{ $jobs->job_name}}</h1>
                <div class="apply">
                    <a href="{{route('vacancy_form', $jobs->id)}}" target="_blank" class="btn btn-warning btn-lg">Apply Now</a>
                </div>
            </div>
            <div class="title mt-4 mb-4"><h2>Employment Type : {{ $jobs->employment_type}}</h2></div>
        </div>
        <div class="row">
            <div class="col-6 konten">
                <div class="responsibilty">
                    <div class="title"><h3>Responsibilities</h3></div>
                    <div class="text">
                        {!!$jobs->responsibilities !!}
                    </div>
                </div>
                <div class="requirements">
                    <div class="title"><h3>Requirements</h3></div>
                    <div class="text">
                        {!!$jobs->requirements !!}
                    </div>
                </div>
            </div>
            <div class="col-6 konten">
                <div class="benefit">
                    <div class="title"><h3>Benefit</h3></div>
                    <div class="text">
                        {!!$jobs->benefit !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



</body>
</html>