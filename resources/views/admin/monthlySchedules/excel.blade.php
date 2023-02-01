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
                        <th>
                            Dia
                        </th>
                        <th>
                            Designação
                        </th>
                        <th>
                            Estudante
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lifeMinistries as $lifeMinistry)
                    @if ($lifeMinistry->disabled)
                        <tr>
                            <td class="d-none"></td>
                            <td>{{ $lifeMinistry->date }}</td>
                            <td>{{ $lifeMinistry->reason }}</td>
                            <td></td>
                        </tr>
                    @else
                        
                    @endif
                    @foreach ($lifeMinistry->lifeMinistryEvents as $lifeMinistryEvent)
                    <tr>
                        <td class="d-none"></td>
                        <td>
                            {{ $lifeMinistry->date }}
                        </td>
                        <td>
                            {{ $lifeMinistryEvent->assignment->name }}
                        </td>
                        <td>
                            {{ $lifeMinistryEvent->student->name }}
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
        let table = $('.datatable-LifeMinistry:not(.ajaxTable)').DataTable({ buttons: dtButtons });
    });
</script>
@endsection