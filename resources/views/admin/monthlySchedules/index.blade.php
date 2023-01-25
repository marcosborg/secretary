@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.monthlySchedule.title') }}
    </div>

    <div class="card-body">
        <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addMeeting">Adicionar
            reunião</button>
        <div id="ajax"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMeeting" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar reunião</h3>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-close"></i></button>
            </div>
            <form action="/admin/forms/addMeeting" method="POST" id="createMeeting">
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

<div class="modal fade" id="editMeeting" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Atualizar reunião</h3>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-close"></i></button>
            </div>
            <form action="/admin/updateMeeting" method="POST" id="updateMeeting">
                <input type="hidden" name="id">
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

<div class="modal fade" id="addEvent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar designação</h3>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-close"></i></button>
            </div>
            <form action="/admin/addEvent" method="POST" id="addEvent">
                <input type="hidden" name="meeting_id">
                @csrf
                <div class="modal-body">

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
<style>
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #cfe2ff;
        background-color: #0a58ca;
        border-color: #cfe2ff #cfe2ff #cfe2ff;
    }

    .nav-tabs .nav-link {
        border: 1px solid #cfe2ff;
        background-color: #cfe2ff;
        color: #777;
    }

    .nav-tabs {
        border-color: #cfe2ff;
    }

    #ajax .card-title {
        margin-bottom: 0;
    }

    .list-group-item-action {
        cursor: pointer;
    }
</style>
@endsection

@section('scripts')
<script src="https://malsup.github.io/jquery.form.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<script>
    addEvent = (meeting_id) => {
        $('#addEvent').modal('show');
    }
</script>
<script>
    $(function() {
        ajax();
        $('#createMeeting #disabled').on('change', () => {
            if ($('#createMeeting #disabled').is(':checked')) {
                $('#createMeeting #reason').removeClass('d-none');
            } else {
                $('#createMeeting #reason').addClass('d-none');
            }
        });
        $('#updateMeeting #disabled').on('change', () => {
            if ($('#updateMeeting #disabled').is(':checked')) {
                $('#updateMeeting #reason').removeClass('d-none');
            } else {
                $('#updateMeeting #reason').addClass('d-none');
            }
        });
        $('#createMeeting').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                $('#addMeeting input[name="date"]').val('');
                $('#addMeeting input[name="disabled"]').prop('checked', false);
                $('#addMeeting input[name="reason"]').val('');
                $('#addMeeting').modal('hide');
                Swal.fire(
                    'Bom trabalho!',
                    'A reunião foi criada com sucesso!',
                    'success'
                ).then(() => {
                    ajax();
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
        $('#updateMeeting').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                console.log(resp);
                $.LoadingOverlay('hide');
                $('#editMeeting input[name="date"]').val('');
                $('#editMeeting input[name="disabled"]').prop('checked', false);
                $('#editMeeting input[name="reason"]').val('');
                $('#editMeeting').modal('hide');
                Swal.fire(
                    'Bom trabalho!',
                    'A reunião foi atualizada com sucesso!',
                    'success'
                ).then(() => {
                    ajax();
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
    ajax = () => {
        $.get('/admin/ajax').then((resp) => {
            $('#ajax').html(resp);
        });
    }
    deleteMeeting = (meeting_id) => {
        Swal.fire({
            title: 'Tem a certeza?',
            text: "Esta operação é irreversível!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, quero apagar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.LoadingOverlay('show');
                $.ajax('/admin/deleteMeeting/' + meeting_id).then((resp) => {
                    $.LoadingOverlay('hide');
                    Swal.fire(
                        'Apagado!',
                        'Pode continuar.',
                        'success'
                    ).then(() => {
                        ajax();
                    });
                });
            }
        });
    }
    editMeeting = (meeting_id) => {
        $.LoadingOverlay('show');
        $.get('/admin/getMeeting/' + meeting_id).then((resp) => {
            $.LoadingOverlay('hide');
            $('#editMeeting input[name="id"]').val(resp.id);
            $('#editMeeting input[name="date"]').val(resp.date);
            if(resp.disabled == 1){
                $('#editMeeting input[name="disabled"]').attr('checked', true);
                $('#editMeeting #reason').removeClass('d-none');
            } else {
                $('#editMeeting input[name="disabled"]').attr('checked', false);
                $('#editMeeting #reason').addClass('d-none');
            }
            $('#editMeeting input[name="reason"]').val(resp.reason);
        });
        $('#editMeeting').modal('show');
    }
</script>
@endsection

@endsection