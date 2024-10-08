@extends('adminlte::page')

@section('title', 'Hiring')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card border-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Applicants</h5>
                <canvas id="applicantChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Applicants per Job</h5> 
                <canvas id="jobChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    
 
    <div class="col-md-6">
        <div class="card border-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Jobs by Department</h5>
                <canvas id="departmentChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

  
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx1 = document.getElementById('applicantChart').getContext('2d');
        var applicantData = @json($applicantData);

        // Grouping by month and year
        const monthlyData = {};
        
        applicantData.forEach(item => {
            const date = new Date(item.date);
            const monthYear = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`; // Format: YYYY-MM
            
            if (!monthlyData[monthYear]) {
                monthlyData[monthYear] = 0;
            }
            monthlyData[monthYear] += item.count;
        });

        // Prepare labels and data for the chart
        const labels = Object.keys(monthlyData);
        const data = Object.values(monthlyData);

        // Chart applicant
        var gradient1 = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        gradient1.addColorStop(1, 'rgba(75, 192, 192, 0.1)');

        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Applicants',
                    data: data,
                    backgroundColor: gradient1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointBorderColor: 'rgba(255, 159, 64, 1)',
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointHoverBorderColor: 'rgba(255, 159, 64, 1)',
                    pointRadius: 5, 
                    pointStyle: 'circle' 
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: { display: true, text: 'Month' },
                        grid: { color: 'rgba(153, 102, 255, 0.2)' },
                        ticks: {
                            padding: 10, 
                            autoSkip: true,
                            maxTicksLimit: 100
                        }
                    },
                    y: {
                        title: { display: true, text: 'Number of Applicants' },
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                }
            }
        });

        // Department Chart
        var ctx2 = document.getElementById('departmentChart').getContext('2d');
        var departmentData = @json($departmentCounts);
        var departmentLabels = Object.keys(departmentData);
        var departmentCounts = Object.values(departmentData);

        var gradient2 = ctx2.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, 'rgba(153, 102, 255, 0.8)');
        gradient2.addColorStop(1, 'rgba(153, 102, 255, 0.2)');

        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: departmentLabels,
                datasets: [{
                    label: 'Number of Jobs',
                    data: departmentCounts,
                    backgroundColor: gradient2,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: { display: true, text: 'Department' }
                    },
                    y: {
                        title: { display: true, text: 'Number of Jobs' },
                        beginAtZero: false, 
                        min: 0, 
                        ticks: {
                            stepSize: 1 
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                }
            }
        });

        // Chart for job applicants
        var ctx3 = document.getElementById('jobChart').getContext('2d'); 
        var jobData = @json($jobCounts);
        var jobLabels = Object.keys(jobData);
        var jobCounts = Object.values(jobData);

        var gradient3 = ctx3.createLinearGradient(0, 0, 0, 400);
        gradient3.addColorStop(0, 'rgba(255, 159, 64, 0.6)'); 
        gradient3.addColorStop(1, 'rgba(255, 159, 64, 0.1)');

        var chart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: jobLabels,
                datasets: [{
                    label: 'Number of Applicants per Job',
                    data: jobCounts,
                    backgroundColor: gradient3,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: { display: true, text: 'Job' }
                    },
                    y: {
                        title: { display: true, text: 'Number of Jobs' },
                        beginAtZero: false, 
                        min: 0, 
                        ticks: {
                            stepSize: 1 
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                }
            }
        });
    });
</script>
@stop
