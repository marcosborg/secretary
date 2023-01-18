@extends('layouts.admin')
@section('content')
@can('shepherding_visit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shepherding-visits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shepherdingVisit.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.shepherdingVisit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShepherdingVisit">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.group') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.publisher') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.datetime') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.shepherding_reason') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.accomplished') }}
                    </th>
                    <th>
                        {{ trans('cruds.shepherdingVisit.fields.next_visit') }}
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
@can('shepherding_visit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shepherding-visits.massDestroy') }}",
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
    ajax: "{{ route('admin.shepherding-visits.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'group_number', name: 'group.number' },
{ data: 'publisher_name', name: 'publisher.name' },
{ data: 'datetime', name: 'datetime' },
{ data: 'shepherding_reason_name', name: 'shepherding_reason.name' },
{ data: 'accomplished', name: 'accomplished' },
{ data: 'next_visit', name: 'next_visit' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ShepherdingVisit').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection