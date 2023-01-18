@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.responsibility.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.responsibilities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.responsibility.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.responsibility.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pioneer') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pioneer" value="0">
                    <input class="form-check-input" type="checkbox" name="pioneer" id="pioneer" value="1" {{ old('pioneer', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pioneer">{{ trans('cruds.responsibility.fields.pioneer') }}</label>
                </div>
                @if($errors->has('pioneer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pioneer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.responsibility.fields.pioneer_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('tik_pioneer') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="tik_pioneer" value="0">
                    <input class="form-check-input" type="checkbox" name="tik_pioneer" id="tik_pioneer" value="1" {{ old('tik_pioneer', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="tik_pioneer">{{ trans('cruds.responsibility.fields.tik_pioneer') }}</label>
                </div>
                @if($errors->has('pioneer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pioneer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.responsibility.fields.pioneer_helper') }}</span>
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