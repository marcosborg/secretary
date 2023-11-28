@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.assignment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assignments.update", [$assignment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.assignment.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $assignment->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.assignment.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="color">{{ trans('cruds.assignment.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $assignment->color) }}" required>
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.assignment.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('technical') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="technical" value="0">
                    <input class="form-check-input" type="checkbox" name="technical" id="technical" value="1" {{ $assignment->technical || old('technical', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="technical">{{ trans('cruds.assignment.fields.technical') }}</label>
                </div>
                @if($errors->has('technical'))
                    <div class="invalid-feedback">
                        {{ $errors->first('technical') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.assignment.fields.technical_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection