<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CV for {{ $applicants->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        h1 {
            font-size: 24px;
            margin: 10px 0;
        }
        h2 {
            font-size: 20px;
            margin: 10px 0;
        }
        h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($applicants->photo_pass)
                <img src="{{ public_path('storage/' . $applicants->photo_pass) }}" alt="Applicant Photo">
            @else
                <img src="https://via.placeholder.com/100" alt="Default Photo">
            @endif
            <h1>{{ $applicants->name }}</h1>
            <p>{{ $applicants->email }}</p>
            <p>{{ $applicants->number }}</p>
        </div>

        <div class="section">
            <h2>Profile</h2>
            <p>{{ $applicants->profile }}</p>
        </div>

        <div class="section">
            <h2>Education</h2>
            <p>{{ $applicants->education }}</p>
        </div>

        <div class="section">
            <h2>Experience</h2>
            <p>{{ $applicants->experience }}</p>
        </div>

        <div class="section">
            <h2>Skills</h2>
            <p>{{ $applicants->skills }}</p>
        </div>

        <div class="section">
            <h2>Languages</h2>
            <p>{{ $applicants->languages }}</p>
        </div>

        <!-- <div class="section">
            <h2>Salary Expectation</h2>
            <p>Rp. {{ number_format($applicants->salary_expectation, 0, ',', '.') }}</p>
        </div> -->
    </div>
</body>
</html>
