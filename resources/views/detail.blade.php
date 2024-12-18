<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .text {
    font-size: 14px; 
    line-height: 1.5;
}
.job-name1 {
    font-size: 24px; 
    font-weight: 600; 
    margin: 0; 
}
.title {
    font-size: 18px;
    line-height: 1.5; 
} 

.shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 255, 0.2); 
    padding: 25px;  
    border-radius: 8px; 
}

</style>

<body>
    

<div class="shadow">
<div class="title mt-4 d-flex justify-content-between">
    <h1 class="job-name1">{{ $job->job_name }}</h1>
    <div class="apply">
   
    <a href="{{ route('vacancy_form', $job->id) }}" class="btn btn-primary btn-sm" target="_blank">Apply Now</a>

</div>
</div>

<!-- Employment Type and Work Location -->
<div class="title mt-3 mb-4">
    <div class="job-detail">
        <i class="fas fa-briefcase"></i>
        <span>Employment Type: {{ $job->employment_type }}</span>
    </div>
    <div class="job-detail">
        <i class="fas fa-map-pin"></i>
        <span>Work Location: {{ $job->workLocation->location }}</span>
    </div>
</div>

</div>
 <br>


<div class="row">
    <div class="col-md-12 responsibilty">
        <div class="title">Responsibilities</div>
        <div class="text">
            {!! $job->responsibilities ?? 'No responsibilities provided.' !!}
        </div>
    </div>
    <div class="col-md-12 requirements">
        <div class="title">Requirements</div>
        <div class="text">{!! $job->requirements ?? 'No requirements provided.' !!}</div>
    </div>
    <div class="col-md-12 benefit">
        <div class="title">Benefit</div>
        <div class="text">{!! $job->benefit !!} </div>
</div>
</div>

</body>
