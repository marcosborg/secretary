@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.monthlySchedule.title') }}
    </div>

    <div class="card-body">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMeeting">Adicionar reunião</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMeeting" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar reunião</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    $(function(){
        $('#disabled').on('change', () => {
            if($('#disabled').is(':checked')){
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
                );
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
</script>
@endsection

@endsection