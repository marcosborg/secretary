@extends('layouts.admin')
@section('content')
@can('life_ministry_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.life-ministries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lifeMinistry.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lifeMinistry.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LifeMinistry">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.disabled') }}
                        </th>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.reason') }}
                        </th>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.meeting') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lifeMinistries as $key => $lifeMinistry)
                        <tr data-entry-id="{{ $lifeMinistry->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $lifeMinistry->id ?? '' }}
                            </td>
                            <td>
                                {{ $lifeMinistry->date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $lifeMinistry->disabled ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $lifeMinistry->disabled ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $lifeMinistry->reason ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\LifeMinistry::MEETING_RADIO[$lifeMinistry->meeting] ?? '' }}
                            </td>
                            <td>
                                @can('life_ministry_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.life-ministries.show', $lifeMinistry->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('life_ministry_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.life-ministries.edit', $lifeMinistry->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('life_ministry_delete')
                                    <form action="{{ route('admin.life-ministries.destroy', $lifeMinistry->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('life_ministry_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.life-ministries.massDestroy') }}",
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
  let table = $('.datatable-LifeMinistry:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection