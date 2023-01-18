@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Total de horas do grupo
            </div>
            <div class="card-body">
                <canvas id="hours"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Outros dados
            </div>
            <div class="card-body">
                <canvas id="others"></canvas>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Publicadores</div>
                <span class="badge text-bg-secondary">{{ $publishers->count() }}</span>
            </div>
            <div class="list-group">
                @foreach ($publishers as $publisher)
                <a href="/admin/report-by-publisher/{{ $publisher->id }}"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <div><strong>{{ $publisher->name }}</strong></div>
                        @foreach ($publisher->responsibilities as $responsability)
                        <span class="badge text-bg-info">{{ $responsability->name }}</span>
                        @endforeach
                    </div>
                    <i class="fa-fw fas fa-angle-right"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    let months = {!! $months !!};
    let labels = [];
    let hours = [];
    let publications = [];
    let revisits = [];
    let videos = [];
    let studies = [];
    months.forEach(month => {
        labels.push(month.name);
        hours.push(month.hours);
        publications.push(month.publications);
        videos.push(month.videos);
        revisits.push(month.revisits);
        studies.push(month.studies);
    });
    const hoursGraph = document.getElementById('hours');
    new Chart(hoursGraph, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
            label: 'Horas',
            backgroundColor: 'lightblue',
            borderColor: 'blue',
            data: hours,
            borderWidth: 1
            }]
        },
        options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
    });
    const othersGraph = document.getElementById('others');
    new Chart(othersGraph, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
            {
            label: 'Publicações',
            fill: false,
            borderColor: 'red',
            data: publications,
            borderWidth: 2
            },
            {
            label: 'Videos',
            fill: false,
            borderColor: 'green',
            data: videos,
            borderWidth: 2
            },
            {
            label: 'Revisitas',
            fill: false,
            borderColor: 'orange',
            data: revisits,
            borderWidth: 2
            },
            {
            label: 'Estudos',
            fill: false,
            borderColor: 'darkgreen',
            data: studies,
            borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection