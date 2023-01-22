@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.monthlySchedule.title') }}
    </div>

    <div class="card-body">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMeeting">Adicionar reunião</button>
        @php
        $yearCount = 0;
        @endphp
        <ul class="nav nav-tabs" role="tablist">
            @foreach($lifeMinistries as $key => $year)
            @php
            $yearCount++;
            @endphp
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $yearCount == 1 ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $key }}" type="button" role="tab" aria-controls="tab-pane-{{ $key }}" aria-selected="true">{{ $key }}</button>
            </li>
            @endforeach
        </ul>
        @php
        $yearCount = 0;
        @endphp
        <div class="tab-content">
            @foreach($lifeMinistries as $key => $year)
            @php
            $yearCount++;
            @endphp
            <div class="tab-pane fade show {{ $yearCount == 1 ? 'active' : '' }}" id="tab-pane-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}" tabindex="{{ $yearCount }}">
                @php
                $monthCount = 0;
                @endphp
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($year as $monthName => $month)
                    @php
                    $monthCount++;
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $monthCount == 1 ? 'active' : '' }}" id="tab-{{ $monthName }}" data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $monthName }}" type="button" role="tab" aria-controls="tab-pane-{{ $monthName }}" aria-selected="true">{{ $monthName }}</button>
                    </li>
                    @endforeach
                </ul>
                @php
                $monthCount = 0;
                @endphp
                <div class="tab-content">
                    @foreach($year as $monthName => $month)
                    @php
                    $monthCount++;
                    @endphp
                    <div class="tab-pane fade show {{ $monthCount == 1 ? 'active' : '' }}" id="tab-pane-{{ $monthName }}" role="tabpanel" aria-labelledby="tab-{{ $monthName }}" tabindex="{{ $monthCount }}">
                        <div class="row">
                            
                            <div class="col">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        Reunião
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMeeting" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar reunião</h3>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i></button>
            </div>
            <form action="/admin/forms/addMeeting" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data da reunião</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="disabled" name="disabled">
                        <label class="form-check-label" for="disabled">
                            Não será realizada
                        </label>
                    </div>
                    <div class="form-group d-none mt-4" id="reason">
                        <label>Motivo</label>
                        <input type="text" class="form-control" name="reason">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('styles')

@endsection

@section('scripts')
<script src="https://malsup.github.io/jquery.form.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
    $(function() {
        $('#disabled').on('change', () => {
            if ($('#disabled').is(':checked')) {
                $('#reason').removeClass('d-none');
            } else {
                $('#reason').addClass('d-none');
            }
        });
        $('form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                Swal.fire(
                    'Bom trabalho!',
                    'A reunião foi criada com sucesso!',
                    'success'
                ).then(() => {
                    location.reload();
                });
            },
            error: (err) => {
                $.LoadingOverlay('hide');
                let error = err.responseJSON.message;
                Swal.fire(
                    'Erro de validação!',
                    error,
                    'error'
                );
            }
        });
    });

    console.log({!!$lifeMinistries!!});
</script>
@endsection

@endsection