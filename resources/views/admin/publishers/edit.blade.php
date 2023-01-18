@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.publisher.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.publishers.update", [$publisher->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.publisher.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $publisher->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="full_name">{{ trans('cruds.publisher.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $publisher->full_name) }}">
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.publisher.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $publisher->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.publisher.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $publisher->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="emergency">{{ trans('cruds.publisher.fields.emergency') }}</label>
                <input class="form-control {{ $errors->has('emergency') ? 'is-invalid' : '' }}" type="text" name="emergency" id="emergency" value="{{ old('emergency', $publisher->emergency) }}">
                @if($errors->has('emergency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emergency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.emergency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="celphone">{{ trans('cruds.publisher.fields.celphone') }}</label>
                <input class="form-control {{ $errors->has('celphone') ? 'is-invalid' : '' }}" type="text" name="celphone" id="celphone" value="{{ old('celphone', $publisher->celphone) }}">
                @if($errors->has('celphone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('celphone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.celphone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="baptism">{{ trans('cruds.publisher.fields.baptism') }}</label>
                <input class="form-control date {{ $errors->has('baptism') ? 'is-invalid' : '' }}" type="text" name="baptism" id="baptism" value="{{ old('baptism', $publisher->baptism) }}">
                @if($errors->has('baptism'))
                    <div class="invalid-feedback">
                        {{ $errors->first('baptism') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.baptism_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birth">{{ trans('cruds.publisher.fields.birth') }}</label>
                <input class="form-control date {{ $errors->has('birth') ? 'is-invalid' : '' }}" type="text" name="birth" id="birth" value="{{ old('birth', $publisher->birth) }}">
                @if($errors->has('birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.publisher.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $publisher->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsibilities">{{ trans('cruds.publisher.fields.responsibilities') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('responsibilities') ? 'is-invalid' : '' }}" name="responsibilities[]" id="responsibilities" multiple>
                    @foreach($responsibilities as $id => $responsibility)
                        <option value="{{ $id }}" {{ (in_array($id, old('responsibilities', [])) || $publisher->responsibilities->contains($id)) ? 'selected' : '' }}>{{ $responsibility }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsibilities'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsibilities') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.responsibilities_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('rgpd') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="rgpd" value="0">
                    <input class="form-check-input" type="checkbox" name="rgpd" id="rgpd" value="1" {{ $publisher->rgpd || old('rgpd', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="rgpd">{{ trans('cruds.publisher.fields.rgpd') }}</label>
                </div>
                @if($errors->has('rgpd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rgpd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.rgpd_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('dav') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="dav" value="0">
                    <input class="form-check-input" type="checkbox" name="dav" id="dav" value="1" {{ $publisher->dav || old('dav', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="dav">{{ trans('cruds.publisher.fields.dav') }}</label>
                </div>
                @if($errors->has('dav'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dav') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.dav_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dav_expiration">{{ trans('cruds.publisher.fields.dav_expiration') }}</label>
                <input class="form-control date {{ $errors->has('dav_expiration') ? 'is-invalid' : '' }}" type="text" name="dav_expiration" id="dav_expiration" value="{{ old('dav_expiration', $publisher->dav_expiration) }}">
                @if($errors->has('dav_expiration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dav_expiration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.dav_expiration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="group_id">{{ trans('cruds.publisher.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $publisher->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publisher.fields.group_helper') }}</span>
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