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
    <div class="title"><h1>{{ $jobs->job_name}}</h1></div>
    <div class="kontainer_vacancy">
        <div class="row">
            <div class="col-6 konten">
                <div class="benefit">{!!$jobs->responsibilities !!}</div>
            </div>
            <div class="col-6 konten">
                <div class="benefit">{!!$jobs->benefit !!}</div>
            </div>
        </div>
    </div>

</div>



</body>
</html>