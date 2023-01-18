@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publisher.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.publishers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.id') }}
                        </th>
                        <td>
                            {{ $publisher->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.name') }}
                        </th>
                        <td>
                            {{ $publisher->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.full_name') }}
                        </th>
                        <td>
                            {{ $publisher->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.address') }}
                        </th>
                        <td>
                            {{ $publisher->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.phone') }}
                        </th>
                        <td>
                            {{ $publisher->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.emergency') }}
                        </th>
                        <td>
                            {{ $publisher->emergency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.celphone') }}
                        </th>
                        <td>
                            {{ $publisher->celphone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.baptism') }}
                        </th>
                        <td>
                            {{ $publisher->baptism }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.birth') }}
                        </th>
                        <td>
                            {{ $publisher->birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.email') }}
                        </th>
                        <td>
                            {{ $publisher->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.responsibilities') }}
                        </th>
                        <td>
                            @foreach($publisher->responsibilities as $key => $responsibilities)
                                <span class="label label-info">{{ $responsibilities->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.rgpd') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $publisher->rgpd ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.dav') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $publisher->dav ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.dav_expiration') }}
                        </th>
                        <td>
                            {{ $publisher->dav_expiration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.group') }}
                        </th>
                        <td>
                            {{ $publisher->group->number ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.publishers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#overseer_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#helper_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="overseer_groups">
            @includeIf('admin.publishers.relationships.overseerGroups', ['groups' => $publisher->overseerGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="helper_groups">
            @includeIf('admin.publishers.relationships.helperGroups', ['groups' => $publisher->helperGroups])
        </div>
    </div>
</div>

@endsection