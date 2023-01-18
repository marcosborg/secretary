@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eldersMeeting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.elders-meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <form action="/admin/elders-meetings/sendByEmail" method="post" style="display: contents;">
                    @csrf
                    
                    <button class="btn btn-default" type="submit">
                        <i class="fa-fw fas fa-envelope"></i>
                    </button>
                </form>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eldersMeeting.fields.id') }}
                        </th>
                        <td>
                            {{ $eldersMeeting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eldersMeeting.fields.datetime') }}
                        </th>
                        <td>
                            {{ $eldersMeeting->datetime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eldersMeeting.fields.subject') }}
                        </th>
                        <td>
                            {{ $eldersMeeting->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eldersMeeting.fields.report') }}
                        </th>
                        <td>
                            {!! $eldersMeeting->report !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.elders-meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection