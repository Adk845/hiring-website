<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vacancy.list.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header p-4 d-flex flex-lg-row flex-sm-column justify-content-between" style="background-image: url({{asset('assets/bg.jpg')}}); background-repeat: no-repeat; background-size: cover">
            {{-- <div>
                <img src="{{asset('assets/bg.jpg')}}" width="40%" alt="">
            </div> --}}
            <div class="logo flex-lg">
                <img src="{{asset('assets/ISOLOGO.png')}}" width="200px" alt="">
            </div>
            <div class="title">
                <h1>Open Hiring</h1>
            </div>
            {{-- <div class="title mt-4 mb-4 "><h1>Open Hiring</h1></div> --}}
        </div>

        <div class="title mb-5 mt-4">
            <h1>Open Recruitment List</h1>
        </div>

        @foreach($jobs as $job)
            <a href="{{route('vacancy', $job->id)}}" style="text-decoration: none" target="_blank">
                <div class="row vacancy_kontainer">
                    <div class="col vacancy">
                        <p class="name">{{$job->job_name}}</p>
                    </div> 
                </div>   
            </a> 
        
         @endforeach

    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>