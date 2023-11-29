@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lifeMinistry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.life-ministries.update", [$lifeMinistry->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.lifeMinistry.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $lifeMinistry->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistry.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('disabled') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="disabled" value="0">
                    <input class="form-check-input" type="checkbox" name="disabled" id="disabled" value="1" {{ $lifeMinistry->disabled || old('disabled', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disabled">{{ trans('cruds.lifeMinistry.fields.disabled') }}</label>
                </div>
                @if($errors->has('disabled'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disabled') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistry.fields.disabled_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reason">{{ trans('cruds.lifeMinistry.fields.reason') }}</label>
                <input class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text" name="reason" id="reason" value="{{ old('reason', $lifeMinistry->reason) }}">
                @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistry.fields.reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.lifeMinistry.fields.meeting') }}</label>
                @foreach(App\Models\LifeMinistry::MEETING_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('meeting') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="meeting_{{ $key }}" name="meeting" value="{{ $key }}" {{ old('meeting', $lifeMinistry->meeting) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="meeting_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('meeting'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lifeMinistry.fields.meeting_helper') }}</span>
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