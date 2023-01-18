@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="/admin/dashboard/change_month" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                Dashboard
                            </div>
                            <div class="col-2">
                                <select name="month_id" class="form-control">
                                    @foreach ($months as $selectedMonth)
                                    <option {{ $month->id == $selectedMonth->id ? 'selected' : '' }} value="{{
                                        $selectedMonth->id }}">{{ $selectedMonth->year->name }} - {{
                                        $selectedMonth->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success block">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <div>{{ $settings1['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <div>{{ $settings2['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings3['total_number']) }}</div>
                                    <div>{{ $settings3['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings4['total_number']) }}</div>
                                    <div>{{ $settings4['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="text-center m-4">Últimos meses</h3>
                        </div>
                        <div class="col-md-12">
                            <canvas id="collectedMonths" width="400" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    let collectedMonths = {!! $collectedMonths !!};
    const ctx = document.getElementById('collectedMonths');
    let labels = [];
    let hours = [];
    let publications = [];
    let videos = [];
    let revisits = [];
    let studies = [];
    collectedMonths.forEach(element => {
        labels.push(element.name);
        hours.push(element.hours);
        publications.push(element.publications);
        videos.push(element.videos);
        revisits.push(element.revisits);
        studies.push(element.studies);
    });
    let data = [];
    data.push({
        label: 'Horas',
        data: hours,
        fill: false,
        borderColor: 'blue',
        borderWidth: 1
    });
    data.push({
        label: 'Publicações',
        data: publications,
        fill: false,
        borderColor: 'red',
        borderWidth: 1
    });
    data.push({
        label: 'Videos',
        data: videos,
        fill: false,
        borderColor: 'green',
        borderWidth: 1
    });
    data.push({
        label: 'Revisitas',
        data: revisits,
        fill: false,
        borderColor: 'orange',
        borderWidth: 1
    });
    data.push({
        label: 'Estudos',
        data: studies,
        fill: false,
        borderColor: 'darkgray',
        borderWidth: 1
    });
    const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: data,
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