@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.groupPublisher.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.publisher.fields.name') }}
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
                            {{ trans('cruds.publisher.fields.responsibilities') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.rgpd') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.dav') }}
                        </th>
                        <th>
                            {{ trans('cruds.publisher.fields.dav_expiration') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>console.log({!! $user->group !!})</script>
@endsection