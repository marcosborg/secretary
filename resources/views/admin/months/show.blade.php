@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.month.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.months.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.month.fields.id') }}
                        </th>
                        <td>
                            {{ $month->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.month.fields.year') }}
                        </th>
                        <td>
                            {{ $month->year->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.month.fields.name') }}
                        </th>
                        <td>
                            {{ $month->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.month.fields.number') }}
                        </th>
                        <td>
                            {{ $month->number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.months.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection