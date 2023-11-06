@extends('layouts.admin')
@section('content')

@if ($user->group)
<div class="card">
    <div class="card-header">
        {{ trans('cruds.groupReport.title') }} {{ $user->group->number }}
    </div>
    <div class="card-body">
        <p>
            Olá, irmão {{ $user->name }}!
        </p>
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
                        tabindex="{{ $index }}">
                        @if (session('status'))
                        <div class="alert alert-success mt-4">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="/admin/updateReport" method="post">
                            @csrf
                            <table class="table table-striped-columns mt-4">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Pioneiro</th>
                                        <th>Participou no ministério?</th>
                                        <th>Horas</th>
                                        <th>Estudos</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($month->publishers as $publisher)
                                    @if ($publisher->report)
                                    @php
                                        if(!$publisher->report->preached) {
                                            $missingReports->add($publisher->name);
                                        }
                                    @endphp
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
                                        <td>
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="report-{{ $publisher->report->id }}-preached"
                                                    id="preached{{ $publisher->id }}" {{ $publisher->report->preached ? 'checked' : '' }}>
                                                <label class="form-check-label" for="preached{{ $publisher->id }}">
                                                    Sim
                                                </label>
                                            </div>
                                        </td>
                                        <td><input type="number" name="report-{{ $publisher->report->id }}-hours"
                                                value="{{ $publisher->report->hours }}" class="form-control" required>
                                        </td>
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
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Pioneiro</th>
                                        <th>Participou no ministério?</th>
                                        <th>Horas</th>
                                        <th>Estudos</th>
                                        <th>Observações</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <p><button class="btn btn-success btn-lg" role="button" type="submit">Gravar</button></p>
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
                                    <th>Horas</th>
                                    <th>Estudos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Publicadores</th>
                                    <td>{{ $month->publishers->count() - $month->pioneerCount -
                                        $month->regularPioneersCount }}</td>
                                    <td>{{ $month->hoursTotal - $month->hoursPioneersTotal -
                                        $month->hoursRegularPioneersTotal }}</td>
                                    <td>{{ $month->studiesTotal - $month->studiesPioneersTotal -
                                        $month->studiesRegularPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Pioneiros auxiliares</th>
                                    <td>{{ $month->pioneerCount }}</td>
                                    <td>{{ $month->hoursPioneersTotal }}</td>
                                    <td>{{ $month->studiesPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Pioneiros regulares</th>
                                    <td>{{ $month->regularPioneersCount }}</td>
                                    <td>{{ $month->hoursRegularPioneersTotal }}</td>
                                    <td>{{ $month->studiesRegularPioneersTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Totais</th>
                                    <th>{{ $month->publishers->count() }}</th>
                                    <th>{{ $month->hoursTotal }}</th>
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
        <a href="/admin/report-by-group/{{ $user->group->id }}" class="btn btn-primary btn-sm">Análise do grupo</a>
    </div>
</div>
@else
<div class="alert alert-primary" role="alert">
    Ainda não existe um grupo atribuido.
</div>
@endif

@endsection