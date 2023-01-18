@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.responsibility.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.responsibilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.responsibility.fields.id') }}
                        </th>
                        <td>
                            {{ $responsibility->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.responsibility.fields.name') }}
                        </th>
                        <td>
                            {{ $responsibility->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.responsibility.fields.pioneer') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $responsibility->pioneer ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.responsibility.fields.tik_pioneer') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $responsibility->tik_pioneer ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.responsibilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection