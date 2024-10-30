<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vacancy.list.css')}}">
    <title>vacancy list</title>
</head>
<body>
    <div class="container">
        
           
        

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