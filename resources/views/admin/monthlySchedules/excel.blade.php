@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Exportar
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LifeMinistry">
                <thead>
                    <tr>
                        <th class="d-none"></th>
                        <th class="d-none">ID</th>
                        <th>
                            Dia
                        </th>
                        <th>
                            Designação
                        </th>
                        <th>
                            Estudante
                        </th>
                        <th>
                            Sexo
                        </th>
                        <th>
                            Responsabilidade
                        </th>
                        <th class="d-none">Posição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lifeMinistries as $lifeMinistry)
                    @if ($lifeMinistry->disabled)
                        <tr>
                            <td class="d-none"></td>
                            <td class="d-none"></td>
                            <td>{{ $lifeMinistry->date }}</td>
                            <td>{{ $lifeMinistry->reason }}</td>
                            <td></td>
                            <td class="d-none"></td>
                        </tr>
                    @else
                        
                    @endif
                    @foreach ($lifeMinistry->lifeMinistryEvents as $lifeMinistryEvent)
                    <tr>
                        <td class="d-none"></td>
                        <td class="d-none">{{ $lifeMinistryEvent->id }}</td>
                        <td>
                            {{ $lifeMinistry->date }}
                        </td>
                        <td>
                            {{ $lifeMinistryEvent->assignment->name }}
                        </td>
                        <td>
                            {{ $lifeMinistryEvent->student->name ?? 'Eliminado' }}
                        </td>
                        <td>
                            {{ \App\Models\Student::GENDER_RADIO[$lifeMinistryEvent->student->gender] ?? '' }}
                        </td>
                        <td>
                            {{ \App\Models\Student::RESPONSIBILITY_RADIO[$lifeMinistryEvent->student->responsibility] ?? '' }}
                        </td>
                        <td class="d-none">
                            {{ $lifeMinistryEvent->position }}
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let table = $('.datatable-LifeMinistry:not(.ajaxTable)').DataTable({ 
            buttons: dtButtons,
            order: [[ 2, 'asc' ], [ 1, 'asc' ], [ 5, 'asc']]
         });
    });
</script>
@endsection
<script>console.log({!! $lifeMinistries !!})</script>