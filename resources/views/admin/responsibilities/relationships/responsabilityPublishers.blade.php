@can('publisher_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.publishers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publisher.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.publisher.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-responsabilityPublishers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.emergency') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.celphone') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.baptism') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.responsability') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishers as $key => $publisher)
                        <tr data-entry-id="{{ $publisher->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $publisher->id ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->name ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->address ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->phone ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->emergency ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->celphone ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->baptism ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->birth ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->email ?? '' }}
                            </td>
                            <td>
                                {{ $publisher->responsability->name ?? '' }}
                            </td>
                            <td>
                                @can('publisher_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.publishers.show', $publisher->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('publisher_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.publishers.edit', $publisher->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('publisher_delete')
                                    <form action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('publisher_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.publishers.massDestroy') }}",
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
  let table = $('.datatable-responsabilityPublishers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection