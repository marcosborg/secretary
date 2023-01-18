@extends('layouts.admin')
@section('content')
@can('receipt_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.receipts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.receipt.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.receipt.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Receipt">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.worldwide_work') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.local_congregation_expenses') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.other') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.completed_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.receipt.fields.verified_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('receipt_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.receipts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.receipts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date', name: 'date' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'worldwide_work', name: 'worldwide_work' },
{ data: 'local_congregation_expenses', name: 'local_congregation_expenses' },
{ data: 'other', name: 'other' },
{ data: 'completed_by_name', name: 'completed_by.name' },
{ data: 'verified_by_name', name: 'verified_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Receipt').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection