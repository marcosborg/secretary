@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.group.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.group.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overseer_id">{{ trans('cruds.group.fields.overseer') }}</label>
                <select class="form-control select2 {{ $errors->has('overseer') ? 'is-invalid' : '' }}" name="overseer_id" id="overseer_id">
                    @foreach($overseers as $id => $entry)
                        <option value="{{ $id }}" {{ old('overseer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('overseer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overseer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.overseer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="helper_id">{{ trans('cruds.group.fields.helper') }}</label>
                <select class="form-control select2 {{ $errors->has('helper') ? 'is-invalid' : '' }}" name="helper_id" id="helper_id">
                    @foreach($helpers as $id => $entry)
                        <option value="{{ $id }}" {{ old('helper_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('helper'))
                    <div class="invalid-feedback">
                        {{ $errors->first('helper') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.helper_helper') }}</span>
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