@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lifeMinistry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.life-ministries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.id') }}
                        </th>
                        <td>
                            {{ $lifeMinistry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.date') }}
                        </th>
                        <td>
                            {{ $lifeMinistry->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.disabled') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $lifeMinistry->disabled ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lifeMinistry.fields.reason') }}
                        </th>
                        <td>
                            {{ $lifeMinistry->reason }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.life-ministries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection