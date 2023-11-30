@php
$yearCount = 0;
@endphp
<ul class="nav nav-tabs" role="tablist">
    @foreach($lifeMinistries as $key => $year)
    @php
    $yearCount++;
    @endphp
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $lifeMinistries->count() == $yearCount ? 'active' : '' }}" id="tab-{{ $key }}"
            data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $key }}" type="button" role="tab"
            aria-controls="tab-pane-{{ $key }}" aria-selected="true">{{ $key }}</button>
    </li>
    @endforeach
</ul>
@php
$yearCount = 0;
@endphp
<div class="tab-content mt-4">
    @foreach($lifeMinistries as $key => $year)
    @php
    $yearCount++;
    @endphp
    <div class="tab-pane fade show {{ $lifeMinistries->count() == $yearCount ? 'active' : '' }}"
        id="tab-pane-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}" tabindex="{{ $yearCount }}">
        @php
        $monthCount = 0;
        @endphp
        <ul class="nav nav-tabs" role="tablist">
            @foreach($year as $monthName => $month)
            @php
            $monthCount++;
            @endphp
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $monthCount == $year->count() ? 'active' : '' }}" id="tab-{{ $monthName }}"
                    data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $monthName }}" type="button" role="tab"
                    aria-controls="tab-pane-{{ $monthName }}" aria-selected="true">{{ $monthName }}</button>
            </li>
            @endforeach
        </ul>
        @php
        $monthCount = 0;
        @endphp
        <div class="tab-content mt-4">
            @foreach($year as $monthName => $month)
            @php
            $monthCount++;
            @endphp
            <div class="tab-pane fade show {{ $monthCount == $year->count() ? 'active' : '' }}"
                id="tab-pane-{{ $monthName }}" role="tabpanel" aria-labelledby="tab-{{ $monthName }}"
                tabindex="{{ $monthCount }}">
                <div class="row">
                    @foreach($month as $meeting)
                    @if ($meeting->meeting == 1 && session()->get('meeting_radio') == 1 || $meeting->meeting == 2 &&
                    session()->get('meeting_radio') == 2)
                    <div class="col">
                        <div class="card">
                            <div
                                class="card-header bg-{{ $meeting->meeting == 1 ? 'info' : 'danger' }} text-white text-uppercase d-flex justify-content-between">
                                <h5 class="card-title">Dia {{ \Carbon\Carbon::parse($meeting->date)->day }}</h5>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-sm text-white" onclick="editMeeting({{ $meeting->id }})"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm text-white" onclick="deleteMeeting({{ $meeting->id }})"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            @if ($meeting->disabled)
                            <div class="card-body">
                                <div class="text-center">
                                    <button class="btn btn-default btn-sm" disabled>Adicionar</button>
                                </div>
                            </div>
                            <div class="alert alert-warning mx-2 text-center" role="alert">
                                <strong>{{ $meeting->reason }}</strong>
                            </div>
                            @else
                            <div class="card-body">
                                <div class="text-center">
                                    <button class="btn btn-default btn-sm"
                                        onclick="addEvent({{ $meeting->id }})">Adicionar</button>
                                </div>
                            </div>
                            @if ($meeting->lifeMinistryEvents->count() > 0)
                            <ul class="list-group list-group-flush sortable" id="meeting_{{ $meeting->id }}">
                                @foreach ($meeting->lifeMinistryEvents as $assignment)
                                @if ($assignment->assignment->technical && session()->has('technical') ||
                                !$assignment->assignment->technical)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
                                    style="background: {{ $assignment->assignment->color }};"
                                    onclick="updateEvent({{ $assignment->id }})" data-meeting="{{ $meeting->id }}"
                                    data-event="{{ $assignment->id }}">
                                    <div class="ms-2 me-auto">
                                        <strong>{{ $assignment->assignment->name }}</strong><br>
                                        {!! $assignment->student_count > 1 ? '<span class="badge badge-danger">&nbsp;' .
                                            $assignment->student_count . '</span>' : '' !!}
                                        {{ $assignment->student ? $assignment->student->name : 'Eliminado' }}
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            @else
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                    Ainda não existem designações agendadas
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <a href="/admin/monthToExcel/{{ $month[0]->id }}" class="btn btn-success">Exportar via Excel</a>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
<script>
    console.log({!! $lifeMinistries !!})
</script>