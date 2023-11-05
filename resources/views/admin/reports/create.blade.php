@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="month_id">{{ trans('cruds.report.fields.month') }}</label>
                <select class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month_id" id="month_id" required>
                    @foreach($months as $id => $entry)
                        <option value="{{ $id }}" {{ old('month_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="publisher_id">{{ trans('cruds.report.fields.publisher') }}</label>
                <select class="form-control select2 {{ $errors->has('publisher') ? 'is-invalid' : '' }}" name="publisher_id" id="publisher_id" required>
                    @foreach($publishers as $id => $entry)
                        <option value="{{ $id }}" {{ old('publisher_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('publisher'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publisher') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.publisher_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('preached') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="preached" value="0">
                    <input class="form-check-input" type="checkbox" name="preached" id="preached" value="1" {{ old('preached', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="preached">{{ trans('cruds.report.fields.preached') }}</label>
                </div>
                @if($errors->has('preached'))
                    <div class="invalid-feedback">
                        {{ $errors->first('preached') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.preached_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="publications">{{ trans('cruds.report.fields.publications') }}</label>
                <input class="form-control {{ $errors->has('publications') ? 'is-invalid' : '' }}" type="number" name="publications" id="publications" value="{{ old('publications', '0') }}" step="1" required>
                @if($errors->has('publications'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publications') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.publications_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="videos">{{ trans('cruds.report.fields.videos') }}</label>
                <input class="form-control {{ $errors->has('videos') ? 'is-invalid' : '' }}" type="number" name="videos" id="videos" value="{{ old('videos', '0') }}" step="1" required>
                @if($errors->has('videos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('videos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.videos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hours">{{ trans('cruds.report.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', '0') }}" step="1" required>
                @if($errors->has('hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="revisits">{{ trans('cruds.report.fields.revisits') }}</label>
                <input class="form-control {{ $errors->has('revisits') ? 'is-invalid' : '' }}" type="number" name="revisits" id="revisits" value="{{ old('revisits', '0') }}" step="1" required>
                @if($errors->has('revisits'))
                    <div class="invalid-feedback">
                        {{ $errors->first('revisits') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.revisits_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="studies">{{ trans('cruds.report.fields.studies') }}</label>
                <input class="form-control {{ $errors->has('studies') ? 'is-invalid' : '' }}" type="number" name="studies" id="studies" value="{{ old('studies', '0') }}" step="1" required>
                @if($errors->has('studies'))
                    <div class="invalid-feedback">
                        {{ $errors->first('studies') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.studies_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pioneer') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pioneer" value="0">
                    <input class="form-check-input" type="checkbox" name="pioneer" id="pioneer" value="1" {{ old('pioneer', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pioneer">{{ trans('cruds.report.fields.pioneer') }}</label>
                </div>
                @if($errors->has('pioneer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pioneer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.pioneer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observations">{{ trans('cruds.report.fields.observations') }}</label>
                <textarea class="form-control {{ $errors->has('observations') ? 'is-invalid' : '' }}" name="observations" id="observations">{{ old('observations') }}</textarea>
                @if($errors->has('observations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.observations_helper') }}</span>
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