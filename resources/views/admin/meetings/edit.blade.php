@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.meeting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.meetings.update", [$meeting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="month_id">{{ trans('cruds.meeting.fields.month') }}</label>
                <select class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month_id" id="month_id" required>
                    @foreach($months as $id => $entry)
                        <option value="{{ $id }}" {{ (old('month_id') ? old('month_id') : $meeting->month->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.meeting.fields.week') }}</label>
                @foreach(App\Models\Meeting::WEEK_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('week') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="week_{{ $key }}" name="week" value="{{ $key }}" {{ old('week', $meeting->week) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="week_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('week'))
                    <div class="invalid-feedback">
                        {{ $errors->first('week') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.week_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.meeting.fields.meeting') }}</label>
                @foreach(App\Models\Meeting::MEETING_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('meeting') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="meeting_{{ $key }}" name="meeting" value="{{ $key }}" {{ old('meeting', $meeting->meeting) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="meeting_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('meeting'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.meeting_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="presences">{{ trans('cruds.meeting.fields.presences') }}</label>
                <input class="form-control {{ $errors->has('presences') ? 'is-invalid' : '' }}" type="number" name="presences" id="presences" value="{{ old('presences', $meeting->presences) }}" step="1" required>
                @if($errors->has('presences'))
                    <div class="invalid-feedback">
                        {{ $errors->first('presences') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.presences_helper') }}</span>
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