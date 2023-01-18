@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lifeMinistryEvent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.life-ministry-events.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="life_ministry_id">{{ trans('cruds.lifeMinistryEvent.fields.life_ministry') }}</label>
                <select class="form-control select2 {{ $errors->has('life_ministry') ? 'is-invalid' : '' }}" name="life_ministry_id" id="life_ministry_id" required>
                    @foreach($life_ministries as $id => $entry)
                        <option value="{{ $id }}" {{ old('life_ministry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('life_ministry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('life_ministry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistryEvent.fields.life_ministry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="assignment_id">{{ trans('cruds.lifeMinistryEvent.fields.assignment') }}</label>
                <select class="form-control select2 {{ $errors->has('assignment') ? 'is-invalid' : '' }}" name="assignment_id" id="assignment_id" required>
                    @foreach($assignments as $id => $entry)
                        <option value="{{ $id }}" {{ old('assignment_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assignment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assignment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistryEvent.fields.assignment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_id">{{ trans('cruds.lifeMinistryEvent.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistryEvent.fields.student_helper') }}</span>
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