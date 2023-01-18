@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Total de horas de {{ $publisher->name }}
                <a href="/admin/report-by-group/{{ $publisher->group->id }}" class="btn btn-dark btn-sm">Voltar ao
                    grupo</a>
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
    <div class="col-2">
        <div class="card">
            <div class="card-header">
                Médias
            </div>

            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Horas
                    <h5>{{ $average['hours'] }}</h5>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Publicações
                    <h5>{{ $average['publications'] }}</h5>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Vídeos
                    <h5>{{ $average['videos'] }}</h5>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Revisitas
                    <h5>{{ $average['revisits'] }}</h5>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Estudos
                    <h5>{{ $average['studies'] }}</h5>
                </li>
            </ul>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    let months = {!! $months !!};
    console.log({!! $average !!});
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