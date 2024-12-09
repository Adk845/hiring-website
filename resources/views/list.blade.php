<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vacancy.list.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Vacancy List</title>
    <style>
        .vacancy-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        body {
        font-family: 'Poppins', sans-serif;
    }


    .vacancy-container.selected {
    box-shadow: 0 0 15px 5px rgba(0, 123, 255, 0.6);  
    color: #333;  
    border: 3px solid #007bff; /* Add a thick blue border */
}

.vacancy-container:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: 2px solid #007bff; /* Blue border when hovered */
}


        .job-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .job-info {
            font-size: 16px;
            color: #555;
        }

        .filter-search-container {
            margin-bottom: 30px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-item select, .filter-item input {
            width: 250px;
        }

        .job-list-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    height: 70vh;
    overflow-y: scroll; 
    -ms-overflow-style: none; 
    scrollbar-width: none; 
    margin-top: 20px;
}


.job-list-container::-webkit-scrollbar {
    display: none;
}


        .job-details-container {
            padding: 20px;
            max-height: 80vh;
            overflow-y: auto;
            margin-top: -20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .row-container {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }

        .job-details-link {
            text-decoration: none;
            color: inherit;
        }

        /* Styling for dynamic job details */
        .kontainer_vacancy {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .responsibilty, .requirements, .benefit {
            margin-bottom: 20px;
        }

        .responsibilty .title, .requirements .title, .benefit .title {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Form Pencarian di Atas -->
        <div class="filter-search-container">
            <form method="GET" action="{{ route('vacancy.search') }}" style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="filter-item">
                    <input type="text" name="job_name" placeholder="Search by Job Name" value="{{ request()->input('job_name') }}" class="form-control" style="padding: 8px;">
                </div>
                <div class="filter-item">
                    <select name="employment_type" class="form-control" style="padding: 8px;">
                        <option value="">Select Employment Type</option>
                        <option value="Permanent" {{ request()->input('employment_type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                        <option value="Contract" {{ request()->input('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    </select>
                </div>
                <div class="filter-item">
                    <input type="text" name="work_location" placeholder="Search by Location" value="{{ request()->input('work_location') }}" class="form-control" style="padding: 8px;">
                </div>
                <div class="filter-item">
                    <select name="sort" class="form-control" style="padding: 8px;">
                        <option value="asc" {{ request()->input('sort') == 'asc' ? 'selected' : '' }}>Sort A-Z</option>
                        <option value="desc" {{ request()->input('sort') == 'desc' ? 'selected' : '' }}>Sort Z-A</option>
                    </select>
                </div>
                <div class="filter-item">
                    <button type="submit" class="btn btn-primary" style="padding: 8px 15px;">Search</button>
                </div>
            </form>
        </div>

     
<div class="container">
    <div class="row-container">
        <!-- Kolom Kiri (Daftar Lowongan) -->
        <div class="col-4 job-list-container">
    @foreach($jobs as $job)
    <div class="vacancy-container" data-job-id="{{ $job->id }}" onclick="loadJobDetails({{ $job->id }})">
    <p class="job-name">{{ $job->job_name }}</p>
    <div class="job-info">
        <p>Employment Type: {{ $job->employment_type }} <br> Location: {{ $job->workLocation->location }}</p>
    </div>
</div>

    @endforeach
</div>


        <!-- Kolom Kanan (Menampilkan Detail Pekerjaan Dinamis) -->
        <div class="col-8 job-details-container" id="job-details-container">
            <div class="kontainer_vacancy" id="job-details-placeholder">
                <h4>Select a job to view details</h4>
                <p>Please click on a job from the list to see the details here.</p>
            </div>
        </div>
    </div>
</div>

<script>
   function loadJobDetails(jobId) {

    const allJobContainers = document.querySelectorAll('.vacancy-container');
    allJobContainers.forEach(container => {
        container.classList.remove('selected');
    });

    const selectedJobContainer = document.querySelector(`.vacancy-container[data-job-id='${jobId}']`);
    selectedJobContainer.classList.add('selected');

    // Kirim permintaan AJAX untuk mendapatkan detail pekerjaan
    fetch(`/job/${jobId}`)
        .then(response => response.text())
        .then(data => {
            // Masukkan hasil HTML ke dalam kolom kanan
            document.getElementById('job-details-placeholder').innerHTML = data;
        })
        .catch(error => console.error('Error loading job details:', error));
}

</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
