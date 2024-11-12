<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CV for {{ $applicant->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0px;
            padding: 0;
            background-color: white;
            color: #333;
            padding-bottom: 50px;
            /* Memberikan ruang untuk footer */
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0px auto;
            padding: 0px;
            border-radius: 8px;
        }

        .header {
            margin-top: -20px;
            text-align: center;
            margin-bottom: 15px;
            /* Menghapus margin bawah */
        }

        .header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #10375C;
            margin: 0;
            /* Menghapus margin di gambar */
        }

        h1 {
            font-size: 17px;
            margin: 0;
            /* Menghapus margin di h1 */
            color: #10375C;
        }




        .section {
            margin-top: 0;
            /* Mengurangi jarak atas */
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: white;
        }


        .section p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin: 0;
            max-width: 100%;
        }

        h2 {
            font-size: 12px;
            margin-top: 0px;
            margin-bottom: 8px;
            color: #10375C;
            border-bottom: 2px solid #10375C;
            padding-bottom: 3px;
        }

        h3 {
            font-size: 11px;
            margin-bottom: 3px;
            color: #0056b3;
        }

        p {
            margin: 3px 0;
            line-height: 1.4;
            font-size: 10px;
        }

        /* Styles for skills, certificates, and achievements */
        .skills-list,
        .achievement-list,
        .certificates-list {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            list-style-type: none;
            margin: 0;
        }

        .skills-list li,
        .achievement-list li,
        .certificates-list li {
            background-color: #f1f1f1;
            border-radius: 4px;
            padding: 5px 10px;
            margin: 5px;
            font-size: 10px;
            color: #333;
        }

        .skills-list li {
            background-color: #cce5ff;
            color: #004085;
        }

        .achievement-list li {
            background-color: #d4edda;
            color: #155724;
        }

        .certificates-list li {
            background-color: #fff3cd;
            color: #856404;
        }

        .section ul {
            margin-top: 10px;
        }

        .footer {
            display: flex;
            align-content: flex-end;
            justify-content: space-between;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            width: 100%;
            z-index: 999;
        }

        .footer .logo {
            position: absolute;
            left: 5px;
            top: -2px;
            width: 50%;
        }

        .footer .address {
            font-size: 10px;
            text-align: center;
            width: 100%;
        }

        .footer .qr-code {
            position: absolute;
            right: 10px;
            top: -10px;
            width: 80px;
            height: 80px;
        }

        .page-break {
            page-break-before: always;
        }

        @page {
            margin: 20mm;

            @bottom-right {
                content: "Grand Galaxy City Jl. Cordova 3 Blok RGC3 No.58 - Jaka Setia – Bekasi Selatan – Jawa Barat 17147";
                font-size: 10px;
            }

            @bottom-left {
                content: url('{{ public_path(' assets/QR.png') }}');
            }
        }
    </style>

</head>

<body>
    <div class="container">

        <div class="header">

            @if($applicant->photo_pass)
            <img src="{{ public_path('storage/' . $applicant->photo_pass) }}" alt="Applicant Photo">
            @else
            <img src="https://via.placeholder.com/100" alt="Default Photo">
            @endif
            <h1>{{ $applicant->name }}</h1>

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
            <h2>Certificates</h2>
            <ul class="certificates-list">
                @foreach(explode('|', $applicant->certificates) as $certificate)
                <li>{{ trim($certificate) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Skills</h2>
            <ul class="skills-list">
                @foreach(explode('|', $applicant->skills) as $skill)
                <li>{{ trim($skill) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Work Experience</h2>
            @if($applicant->workExperiences->isNotEmpty())
            @foreach($applicant->workExperiences as $experience)
            <h3>{{ $experience->role }}</h3>
            <p><strong>Company:</strong> {{ $experience->name_company }}</p>
            <p><strong>Description:</strong> {{ $experience->desc_kerja }}</p>
            <p><strong>Period:</strong> {{ $experience->mulai }} - {{ $experience->selesai }}</p>
            @endforeach
            @else
            <p>No work experience available.</p>
            @endif
        </div>


        @if($applicant->projects->filter(function($project) {
        return !is_null($project->project_name) && !is_null($project->client) && !is_null($project->desc_project) && !is_null($project->mulai_project) && !is_null($project->selesai_project);
        })->isNotEmpty())
        <div class="section">
            <h2>Projects</h2>
            @foreach($applicant->projects as $project)
            @if(!is_null($project->project_name) && !is_null($project->client) && !is_null($project->desc_project) && !is_null($project->mulai_project) && !is_null($project->selesai_project))
            <h3>{{ $project->project_name }}</h3>
            <p><strong>Client:</strong> {{ $project->client }}</p>
            <p><strong>Description:</strong> {{ $project->desc_project }}</p>
            <p><strong>Period:</strong> {{ $project->mulai_project }} - {{ $project->selesai_project }}</p>
            @endif
            @endforeach
        </div>
        @endif

        <div class="section">
            <h2>Achievements</h2>
            <ul class="achievement-list">
                @foreach(explode('|', $applicant->achievement) as $achievement)
                <li>{{ trim($achievement) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Languages</h2>
            <p>{{ $applicant->languages}}</p>
        </div>

        <div class="section">
            <h2>Additional Information</h2>
            <p><strong>MBTI:</strong> {{ $applicant->mbti ?? 'none' }}</p>
            <p><strong>IQ:</strong> {{ $applicant->iq ?? 'none' }}</p>
        </div>


        @if($applicant->references->filter(function($reference) {
        return !is_null($reference->name_ref) && !is_null($reference->phone) && !is_null($reference->email_ref);
        })->isNotEmpty())
        <div class="section">
            <h2>References</h2>
            @foreach($applicant->references as $reference)
            @if(!is_null($reference->name_ref) && !is_null($reference->phone) && !is_null($reference->email_ref))
            <h3>{{ $reference->name_ref }}</h3>
            <p><strong>Phone Number:</strong> {{ $reference->phone }}</p>
            <p><strong>Email:</strong> {{ $reference->email_ref }}</p>
            @endif
            @endforeach
        </div>
        @endif





    </div>

    <div class="footer">
        <div class="logo">
            <img src="{{ public_path('assets/ISOLOGO.png') }}" alt="Logo" class="logo">
        </div>
        <div class="address">
            Grand Galaxy City Jl. Cordova 3 Blok RGC3 No.58 <br>
            Jaka Setia – Bekasi Selatan – Jawa Barat 17147 <br>
            &copy; {{ date('F Y') }} I-solutions Indonesia. All rights reserved.
        </div>
        <div class="qr-code">
            <img src="{{ public_path('assets/QR.png') }}" alt="QR Code" class="qr-code">
        </div>
    </div>


</body>

</html>