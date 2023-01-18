@extends('layouts.admin')
@section('content')
@can('responsibility_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.responsibilities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.responsibility.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.responsibility.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Responsibility">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.responsibility.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.responsibility.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.responsibility.fields.pioneer') }}
                        </th>
                        <th>
                            {{ trans('cruds.responsibility.fields.tik_pioneer') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responsibilities as $key => $responsibility)
                        <tr data-entry-id="{{ $responsibility->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $responsibility->id ?? '' }}
                            </td>
                            <td>
                                {{ $responsibility->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $responsibility->pioneer ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $responsibility->pioneer ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $responsibility->tik_pioneer ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $responsibility->tik_pioneer ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('responsibility_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.responsibilities.show', $responsibility->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('responsibility_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.responsibilities.edit', $responsibility->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('responsibility_delete')
                                    <form action="{{ route('admin.responsibilities.destroy', $responsibility->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
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
@can('responsibility_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.responsibilities.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Responsibility:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection