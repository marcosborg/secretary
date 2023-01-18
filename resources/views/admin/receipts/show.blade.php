@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.receipt.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receipts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.id') }}
                        </th>
                        <td>
                            {{ $receipt->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.date') }}
                        </th>
                        <td>
                            {{ $receipt->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.photo') }}
                        </th>
                        <td>
                            @if($receipt->photo)
                                <a href="{{ $receipt->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $receipt->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.worldwide_work') }}
                        </th>
                        <td>
                            {{ $receipt->worldwide_work }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.local_congregation_expenses') }}
                        </th>
                        <td>
                            {{ $receipt->local_congregation_expenses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.other') }}
                        </th>
                        <td>
                            {{ $receipt->other }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.receipt.fields.total') }}</th>
                        <td>{{ number_format($receipt->worldwide_work + $receipt->local_congregation_expenses + $receipt->other,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.completed_by') }}
                        </th>
                        <td>
                            {{ $receipt->completed_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receipt.fields.verified_by') }}
                        </th>
                        <td>
                            {{ $receipt->verified_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receipts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection