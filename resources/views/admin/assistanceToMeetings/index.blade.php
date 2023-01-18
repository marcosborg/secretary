@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.assistanceToMeeting.title') }}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ($months as $index => $month)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $index == $months->count() - 1 ? 'active' : '' }}" id="tab{{ $index }}" data-bs-toggle="tab"
                    data-bs-target="#tab-pane-{{ $index }}" type="button" role="tab"
                    aria-controls="tab-pane-{{ $index }}" aria-selected="true">{{ $month->name }}</button>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @if (session('status'))
            <div class="alert alert-success mt-4">
                {{ session('status') }}
            </div>
            @endif
            @foreach ($months as $index => $month)
            <div class="tab-pane fade show {{ $index == $months->count() - 1 ? 'active' : '' }}" id="tab-pane-{{ $index }}" role="tabpanel"
                aria-labelledby="tab{{ $index }}" tabindex="{{ $index }}">
                @if ($month->meetings->count() > 0)
                <form action="/admin/save-assistance" method="post">
                    <input type="hidden" name="month_id" value="{{ $month->id}}" />
                    @csrf
                    <table class="table table-striped-columns mt-4">
                        <thead>
                            <tr>
                                <th>Assistências</th>
                                <th>1.ª semana</th>
                                <th>2.ª semana</th>
                                <th>3.ª semana</th>
                                <th>4.ª semana</th>
                                <th>5.ª semana</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Reunião de semana</th>
                                @php
                                $meeting1 = $month->meetings->where('meeting', 1)->where('week', 1)->first();
                                $meeting2 = $month->meetings->where('meeting', 2)->where('week', 1)->first();
                                $meeting3 = $month->meetings->where('meeting', 1)->where('week', 2)->first();
                                $meeting4 = $month->meetings->where('meeting', 2)->where('week', 2)->first();
                                $meeting5 = $month->meetings->where('meeting', 1)->where('week', 3)->first();
                                $meeting6 = $month->meetings->where('meeting', 2)->where('week', 3)->first();
                                $meeting7 = $month->meetings->where('meeting', 1)->where('week', 4)->first();
                                $meeting8 = $month->meetings->where('meeting', 2)->where('week', 4)->first();
                                $meeting9 = $month->meetings->where('meeting', 1)->where('week', 5)->first();
                                $meeting10 = $month->meetings->where('meeting', 2)->where('week', 5)->first();
                                @endphp
                                <td><input type="number" name="meeting1"
                                        value="{{ $meeting1 ? $meeting1->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting1 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting3"
                                        value="{{ $meeting3 ? $meeting3->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting3 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting5"
                                        value="{{ $meeting5 ? $meeting5->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting5 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting7"
                                        value="{{ $meeting7 ? $meeting7->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting7 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting9"
                                        value="{{ $meeting9 ? $meeting9->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting9 ? '' : 'disabled' }} required>
                                </td>
                            </tr>
                            <tr>
                                <th>Reunião de fim de semana</th>
                                <td><input type="number" name="meeting2"
                                        value="{{ $meeting2 ? $meeting2->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting2 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting4"
                                        value="{{ $meeting4 ? $meeting4->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting4 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting6"
                                        value="{{ $meeting6 ? $meeting6->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting6 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting8"
                                        value="{{ $meeting8 ? $meeting8->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting8 ? '' : 'disabled' }} required>
                                </td>
                                <td><input type="number" name="meeting10"
                                        value="{{ $meeting10 ? $meeting10->presences : '' }}"
                                        class="form-control form-control-lg" {{ $meeting10 ? '' : 'disabled' }}
                                        required></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success btn-lg" type="submit">Gravar</button>
                </form>
                @else
                <div class="alert alert-primary mt-4" role="alert">
                    Ainda não foram criadas as reuniões.
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection