@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.importantDate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.important-dates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.importantDate.fields.id') }}
                        </th>
                        <td>
                            {{ $importantDate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.importantDate.fields.name') }}
                        </th>
                        <td>
                            {{ $importantDate->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.importantDate.fields.date') }}
                        </th>
                        <td>
                            {{ $importantDate->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.importantDate.fields.description') }}
                        </th>
                        <td>
                            {{ $importantDate->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.important-dates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection