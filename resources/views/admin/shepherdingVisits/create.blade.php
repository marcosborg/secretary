@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shepherdingVisit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shepherding-visits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="group_id">{{ trans('cruds.shepherdingVisit.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id" required>
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="publisher_id">{{ trans('cruds.shepherdingVisit.fields.publisher') }}</label>
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
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.publisher_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="datetime">{{ trans('cruds.shepherdingVisit.fields.datetime') }}</label>
                <input class="form-control datetime {{ $errors->has('datetime') ? 'is-invalid' : '' }}" type="text" name="datetime" id="datetime" value="{{ old('datetime') }}" required>
                @if($errors->has('datetime'))
                    <div class="invalid-feedback">
                        {{ $errors->first('datetime') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.datetime_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shepherding_reason_id">{{ trans('cruds.shepherdingVisit.fields.shepherding_reason') }}</label>
                <select class="form-control select2 {{ $errors->has('shepherding_reason') ? 'is-invalid' : '' }}" name="shepherding_reason_id" id="shepherding_reason_id" required>
                    @foreach($shepherding_reasons as $id => $entry)
                        <option value="{{ $id }}" {{ old('shepherding_reason_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shepherding_reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shepherding_reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.shepherding_reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observations">{{ trans('cruds.shepherdingVisit.fields.observations') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('observations') ? 'is-invalid' : '' }}" name="observations" id="observations">{!! old('observations') !!}</textarea>
                @if($errors->has('observations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.observations_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('accomplished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="accomplished" value="0">
                    <input class="form-check-input" type="checkbox" name="accomplished" id="accomplished" value="1" {{ old('accomplished', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="accomplished">{{ trans('cruds.shepherdingVisit.fields.accomplished') }}</label>
                </div>
                @if($errors->has('accomplished'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accomplished') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.accomplished_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="next_visit">{{ trans('cruds.shepherdingVisit.fields.next_visit') }}</label>
                <input class="form-control date {{ $errors->has('next_visit') ? 'is-invalid' : '' }}" type="text" name="next_visit" id="next_visit" value="{{ old('next_visit') }}">
                @if($errors->has('next_visit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('next_visit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shepherdingVisit.fields.next_visit_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.shepherding-visits.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $shepherdingVisit->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection