@extends('layouts.admin')
@section('content')

@if ($user->group)
<div class="card">
    <div class="card-header">
        <div class="btn-group" role="group" aria-label="Basic example">
            @foreach ($groups as $group)
            <a href="/admin/report-by-groups/{{ $group->id }}"
                class="btn btn-secondary {{ $group->id == $user->group->id ? 'active' : '' }}">{{ $group->number
                }}</a>
            @endforeach
        </div>
    </div>
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($years as $key => $year)
                <button class="nav-link {{ $key == $years->count()-1 ? 'active' : '' }}" id="nav-{{ $key }}-tab"
                    data-bs-toggle="tab" data-bs-target="#nav-{{ $key }}" type="button" role="tab"
                    aria-controls="nav-{{ $key }}" aria-selected="true">{{ $year->name }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($years as $key => $year)
            <div class="tab-pane fade {{ $key == $years->count()-1 ? 'show active' : '' }}" id="nav-{{ $key }}"
                role="tabpanel" aria-labelledby="nav-{{ $key }}-tab" tabindex="{{ $key }}">
                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    @foreach ($year->months as $index => $month)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $index == $year->months->count()-1 ? 'active' : '' }}"
                            id="tab-{{ $key }}-{{ $index }}" data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $key }}-{{ $index }}"
                            type="button" role="tab" aria-controls="tab-pane-{{ $key }}-{{ $index }}" aria-selected="true">{{
                            $month->name }}</button>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    @foreach ($year->months as $index => $month)
                    @php
                    $missingReports = collect();
                    @endphp
                    <div class="tab-pane fade {{ $index == $year->months->count()-1 ? 'show active' : '' }}"
                        id="tab-pane-{{ $key }}-{{ $index }}" role="tabpanel" aria-labelledby="tab-{{ $key }}-{{ $index }}"
                        tabindex="{{ $key }}-{{ $index }}">
                        @if (session('status'))
                        <div class="alert alert-success mt-4">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p class="text-right mt-4"><button type="button"
                                onclick="createCsv({{ $user->group->id }}, {{ $month->id }})"
                                class="btn btn-success btn-sm">Exportar CSV</button>
                                <a href="/admin/report-by-group/{{ $user->group->id }}" class="btn btn-dark btn-sm">Análise do grupo</a></p>
                        <form action="/admin/updateReport" method="post">
                            @csrf
                            <table class="table table-striped-columns mt-4">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Pioneiro</th>
                                        <th>Publicações</th>
                                        <th>Videos</th>
                                        <th>Horas</th>
                                        <th>Revisitas</th>
                                        <th>Estudos</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($month->publishers as $publisher)
                                    @if ($publisher->report)
                                    <tr>
                                        <td><input type="text" value="{{ $publisher->name }}" class="form-control"
                                                disabled style="width: 15pc;"></td>
                                        <td>
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="report-{{ $publisher->report->id }}-pioneer"
                                                    id="pioneer{{ $publisher->id }}" {{ $publisher->pioneer ? 'checked
                                                disabled' : '' }} {{ $publisher->report->pioneer ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pioneer{{ $publisher->id }}">
                                                    {{ $publisher->pioneer ? $publisher->pioneer_name : 'Auxiliar' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-publications"
                                                value="{{ $publisher->report->publications }}" class="form-control"
                                                required>
                                        </td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-videos"
                                                value="{{ $publisher->report->videos }}" class="form-control" required>
                                        </td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-hours"
                                                value="{{ $publisher->report->hours }}" class="form-control" required>
                                        </td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-revisits"
                                                value="{{ $publisher->report->revisits }}" class="form-control"
                                                required></td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-studies"
                                                value="{{ $publisher->report->studies }}" class="form-control" required>
                                        </td>
                                        <td><input type="text" name="report-{{ $publisher->report->id }}-observations"
                                                value="{{ $publisher->report->observations }}" class="form-control">
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <p><button class="btn btn-success btn-lg" role="button" type="submit">Gravar</button></p>
                            <table id="table-{{ $user->group->id }}-{{ $month->id }}" class="invisible"
                                style="position: absolute">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Pioneiro</th>
                                        <th>Publicações</th>
                                        <th>Videos</th>
                                        <th>Horas</th>
                                        <th>Revisitas</th>
                                        <th>Estudos</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($month->publishers as $publisher)
                                    @if ($publisher->report)
                                    @php
                                    if($publisher->report->hours == 0){
                                    $missingReports->add($publisher->name);
                                    }
                                    @endphp
                                    <tr>
                                        <td>{{ $publisher->name }}</td>
                                        <td>{{ $publisher->report->pioneer ? 'Pioneiro auxiliar' : '' }}{{
                                            $publisher->pioneer_name }}</td>
                                        <td>{{ $publisher->report->publications }}</td>
                                        <td>{{ $publisher->report->videos }}</td>
                                        <td>{{ $publisher->report->hours }}</td>
                                        <td>{{ $publisher->report->revisits }}</td>
                                        <td>{{ $publisher->report->studies }}</td>
                                        <td>{{ $publisher->report->observations }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                        @if ($missingReports->count() > 0)
                        <div class="mb-4">
                            <h5>Relatórios em falta</h5>
                            @foreach ($missingReports as $missingReport)
                            <span class="badge badge-danger">{{ $missingReport }}</span>
                            @endforeach
                        </div>
                        @endif
                        <table class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Publicadores</th>
                                    <th>Publicações</th>
                                    <th>Videos</th>
                                    <th>Horas</th>
                                    <th>Revisitas</th>
                                    <th>Estudos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Publicadores</th>
                                    <td>{{ $month->publishers->count() - $month->pioneerCount -
                                        $month->regularPioneersCount }}</td>
                                    <td>{{ $month->publicationsTotal - $month->publicationsPioneersTotal -
                                        $month->publicationsRegularPioneersTotal }}</td>
                                    <td>{{ $month->videosTotal - $month->videosPioneersTotal -
                                        $month->videosRegularPioneersTotal }}</td>
                                    <td>{{ $month->hoursTotal - $month->hoursPioneersTotal -
                                        $month->hoursRegularPioneersTotal }}</td>
                                    <td>{{ $month->revisitsTotal - $month->revisitsPioneersTotal -
                                        $month->revisitsRegularPioneersTotal }}</td>
                                    <td>{{ $month->studiesTotal - $month->studiesPioneersTotal -
                                        $month->studiesRegularPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Pioneiros auxiliares</th>
                                    <td>{{ $month->pioneerCount }}</td>
                                    <td>{{ $month->publicationsPioneersTotal }}</td>
                                    <td>{{ $month->videosPioneersTotal }}</td>
                                    <td>{{ $month->hoursPioneersTotal }}</td>
                                    <td>{{ $month->revisitsPioneersTotal }}</td>
                                    <td>{{ $month->studiesPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Pioneiros regulares</th>
                                    <td>{{ $month->regularPioneersCount }}</td>
                                    <td>{{ $month->publicationsRegularPioneersTotal }}</td>
                                    <td>{{ $month->videosRegularPioneersTotal }}</td>
                                    <td>{{ $month->hoursRegularPioneersTotal }}</td>
                                    <td>{{ $month->revisitsRegularPioneersTotal }}</td>
                                    <td>{{ $month->studiesRegularPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Totais</th>
                                    <th>{{ $month->publishers->count() }}</th>
                                    <th>{{ $month->publicationsTotal }}</th>
                                    <th>{{ $month->videosTotal }}</th>
                                    <th>{{ $month->hoursTotal }}</th>
                                    <th>{{ $month->revisitsTotal }}</th>
                                    <th>{{ $month->studiesTotal }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@else
<div class="alert alert-primary" role="alert">
    Ainda não existe um grupo atribuido.
</div>
@endif

@endsection

@section('scripts')
@parent
<script src="/js/vendor/table2csv/dist/table2csv.min.js"></script>
<script>
    createCsv = function(group_id, month_id) {
    $('#table-' + group_id + '-' + month_id).table2csv({
        filename:'group-' + group_id + '.csv'
    });
}
</script>
@endsection