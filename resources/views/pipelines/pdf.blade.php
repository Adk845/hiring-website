<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CV for {{ $applicant->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 30px;
            padding: 0;
            background-color: white;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0px auto;
            padding: 0px;
            border-radius: 8px;

        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #10375C;
            margin-bottom: 15px;
        }

        .logo {
            margin-left: 270px;
            width: 100px;
        }


        h1 {
            font-size: 28px;
            margin: 10px 0;
            color: #10375C;
        }

        .contact-info {
            font-size: 16px;
            margin: 5px 0;
        }

        .section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: white;
        }

        .section p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin: 0;
            max-width: 100%;
        }


        h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #10375C;
            border-bottom: 2px solid #10375C;
            padding-bottom: 5px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #0056b3;
        }

        p {
            margin: 5px 0;
            line-height: 1.5;
        }

        .skills-list,
        .languages-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .skills-list li,
        .languages-list li {
            background-color: #10375C;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            color: #666;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo"> <img src="{{ public_path ('assets/ISOLOGO.png') }}" alt="Logo" class="logo"></div>
        <div class="header">

            @if($applicant->photo_pass)
            <img src="{{ public_path('storage/' . $applicant->photo_pass) }}" alt="Applicant Photo">
            @else
            <img src="https://via.placeholder.com/100" alt="Default Photo">
            @endif
            <h1>{{ $applicant->name }}</h1>
            <div class="contact-info">
                <p>{{ $applicant->profil_linkedin }}</p>
                <p>{{ $applicant->email }}</p>
                <p>{{ $applicant->number }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Profile</h2>
            <p>{{ $applicant->profile }}</p>
        </div>

        <div class="section">
            <h2>Education</h2>
            <p><strong>Education:</strong> {{ $applicant->education->name_education }}</p>
            <p><strong>Major:</strong> {{ $applicant->jurusan->name_jurusan }}</p>
        </div>

        <div class="section">
            <h2>Work Experience</h2>
            @if($applicant->workExperiences->isNotEmpty())
            @foreach($applicant->workExperiences as $experience)
            <h3>{{ $experience->role }}</h3>
            <p><strong>Company:</strong> {{ $experience->name_company }}</p>
            <p><strong>Description:</strong> {{ $experience->desc_kerja }}</p>
            <p><strong>From:</strong> {{ $experience->mulai }} <strong>Until:</strong> {{ $experience->selesai }}</p>
            @endforeach
            @else
            <p>No work experience available.</p>
            @endif
        </div>

        <div class="section">
            <h2>Skills</h2>
            <ul class="skills-list">
                @foreach(explode(',', $applicant->skills) as $skill)
                <li>{{ trim($skill) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Projects</h2>
            @if($applicant->projects->isNotEmpty())
            @foreach($applicant->projects as $project)
            <h3>{{ $project->project_name }}</h3>
            <p><strong>Client:</strong> {{ $project->client }}</p>
            <p><strong>Description:</strong> {{ $project->desc_project }}</p>
            <p><strong>From:</strong> {{ $project->mulai_project }} <strong>Until:</strong> {{ $project->selesai_project }}</p>
            @endforeach
            @else
            <p>No projects available.</p>
            @endif
        </div>

        <div class="section">
            <h2>Achievements</h2>
            <p>{{ $applicant->achievement }}</p>
        </div>

        <div class="section">
            <h2>Certificates</h2>
            <p>{{ $applicant->certificates }}</p>
        </div>

        <div class="section">
            <h2>Languages</h2>
            <p>{{ $applicant->languages}}</p>
        </div>

        <div class="section">
            <h2>Additional Information</h2>
            <p><strong>MBTI:</strong> {{ $applicant->mbti}}</p>
            <p><strong>IQ:</strong> {{ $applicant->iq }}</p>
        </div>

        <div class="section">
            <h2>References</h2>
            @if($applicant->references->isNotEmpty())
            @foreach($applicant->references as $reference)
            <h3>{{ $reference->name_ref }}</h3>
            <p><strong>Phone Number:</strong> {{ $reference->phone }}</p>
            <p><strong>Email:</strong> {{ $reference->email_ref }}</p>
            @endforeach
            @else
            <p>No references available.</p>
            @endif
        </div>


        <div class="footer">
            &copy; {{ date('Y') }} {{ $applicant->name }}. All rights reserved.
        </div>
    </div>
</body>

</html>