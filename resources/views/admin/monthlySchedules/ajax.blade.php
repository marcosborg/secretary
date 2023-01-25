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
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-info text-white text-uppercase d-flex justify-content-between">
                                <h5 class="card-title">Dia {{ \Carbon\Carbon::parse($meeting->date)->day }}</h5>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-sm text-white" onclick="editMeeting({{ $meeting->id }})"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm text-white" onclick="deleteMeeting({{ $meeting->id }})"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <button class="btn btn-default btn-sm"
                                        onclick="addEvent({{ $meeting->id }})">Adicionar designação</button>
                                </div>
                            </div>
                            @if ($meeting->lifeMinistryEvents->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach ($meeting->lifeMinistryEvents as $assignment)
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <strong>{{ $assignment->assignment->name }}</strong><br>
                                        {{ $assignment->student->name }}
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                    Ainda não existem designações agendadas
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
<script>
    console.log({!! $lifeMinistries !!});
</script>