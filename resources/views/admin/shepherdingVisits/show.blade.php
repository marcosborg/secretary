@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shepherdingVisit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shepherding-visits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.id') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.group') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->group->number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.publisher') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->publisher->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.datetime') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->datetime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.shepherding_reason') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->shepherding_reason->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.observations') }}
                        </th>
                        <td>
                            {!! $shepherdingVisit->observations !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.accomplished') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $shepherdingVisit->accomplished ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shepherdingVisit.fields.next_visit') }}
                        </th>
                        <td>
                            {{ $shepherdingVisit->next_visit }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shepherding-visits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection