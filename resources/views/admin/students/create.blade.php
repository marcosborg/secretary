@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.gender') }}</label>
                @foreach(App\Models\Student::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.responsibility') }}</label>
                @foreach(App\Models\Student::RESPONSIBILITY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('responsibility') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="responsibility_{{ $key }}" name="responsibility" value="{{ $key }}" {{ old('responsibility', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="responsibility_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('responsibility'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsibility') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.responsibility_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assignments">{{ trans('cruds.student.fields.assignments') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assignments') ? 'is-invalid' : '' }}" name="assignments[]" id="assignments" multiple>
                    @foreach($assignments as $id => $assignment)
                        <option value="{{ $id }}" {{ in_array($id, old('assignments', [])) ? 'selected' : '' }}>{{ $assignment }}</option>
                    @endforeach
                </select>
                @if($errors->has('assignments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assignments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.assignments_helper') }}</span>
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