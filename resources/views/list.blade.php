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
        
           
        

    <div class="filter-search-container" style="margin-bottom: 30px;">
    <form method="GET" action="{{ route('vacancy.search') }}" style="display: flex; gap: 20px; flex-wrap: wrap;">
        
        <!-- Filter berdasarkan Nama Pekerjaan -->
        <div class="filter-item">
            <input type="text" name="job_name" placeholder="Search by Job Name" value="{{ request()->input('job_name') }}" class="form-control" style="padding: 5px;">
        </div>

        <!-- Filter berdasarkan Employment Type -->
        <div class="filter-item">
            <select name="employment_type" class="form-control" style="padding: 5px;">
                <option value="">Select Employment Type</option>
                <option value="Permanent" {{ request()->input('employment_type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                <!-- <option value="Part-Time" {{ request()->input('employment_type') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option> -->
                <option value="Contract" {{ request()->input('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                <!-- <option value="Internship" {{ request()->input('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option> -->
                
                                  
            </select>
        </div>

        <!-- Filter berdasarkan Work Location -->
        <div class="filter-item">
            <input type="text" name="work_location" placeholder="Search by Location" value="{{ request()->input('work_location') }}" class="form-control" style="padding: 5px;">
        </div>

        <!-- Filter Pengurutan -->
        <div class="filter-item">
            <select name="sort" class="form-control" style="padding: 5px;">
                <option value="asc" {{ request()->input('sort') == 'asc' ? 'selected' : '' }}>Sort A-Z</option>
                <option value="desc" {{ request()->input('sort') == 'desc' ? 'selected' : '' }}>Sort Z-A</option>
            </select>
        </div>

        <!-- Tombol Search -->
        <div class="filter-item">
            <button type="submit" class="btn btn-primary" style="padding: 5px 15px;">Search</button>
        </div>
    </form>
</div>

        
<div class="job-list-container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; row-gap: 20px; max-width: 100%; overflow-x: auto; white-space: nowrap;">
    @foreach($jobs as $job)
        <a href="{{route('vacancy', $job->id)}}" style="text-decoration: none" target="_blank">
            <div class="row vacancy_kontainer" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; transition: all 0.3s ease; position: relative;">
                <div class="col vacancy">
                    <p class="job-name" style="font-weight: bold; font-size: 18px; color: black; margin-bottom: 5px;">{{$job->job_name}}</p>
                </div>
                
                <div class="title mt-1 mb-1">
                    <h5 style="font-weight: normal; font-size: 14px; margin: 0; color: black;">Employment Type: {{ $job->employment_type }}</h5>
                    <h5 style="font-weight: normal; font-size: 14px; margin: 0; color: black;">Work Location: {{ $job->workLocation->location }}</h5>
                </div>
            </div>   
        </a>
    @endforeach
</div>






        
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>