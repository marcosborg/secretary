@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.receipt.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.receipts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.receipt.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.receipt.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worldwide_work">{{ trans('cruds.receipt.fields.worldwide_work') }}</label>
                <input class="form-control {{ $errors->has('worldwide_work') ? 'is-invalid' : '' }}" type="number" name="worldwide_work" id="worldwide_work" value="{{ old('worldwide_work', '') }}" step="0.01">
                @if($errors->has('worldwide_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worldwide_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.worldwide_work_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="local_congregation_expenses">{{ trans('cruds.receipt.fields.local_congregation_expenses') }}</label>
                <input class="form-control {{ $errors->has('local_congregation_expenses') ? 'is-invalid' : '' }}" type="number" name="local_congregation_expenses" id="local_congregation_expenses" value="{{ old('local_congregation_expenses', '') }}" step="0.01">
                @if($errors->has('local_congregation_expenses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('local_congregation_expenses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.local_congregation_expenses_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other">{{ trans('cruds.receipt.fields.other') }}</label>
                <input class="form-control {{ $errors->has('other') ? 'is-invalid' : '' }}" type="number" name="other" id="other" value="{{ old('other', '') }}" step="0.01">
                @if($errors->has('other'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.other_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="completed_by_id">{{ trans('cruds.receipt.fields.completed_by') }}</label>
                <select class="form-control select2 {{ $errors->has('completed_by') ? 'is-invalid' : '' }}" name="completed_by_id" id="completed_by_id" required>
                    @foreach($completed_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('completed_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('completed_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.completed_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="verified_by_id">{{ trans('cruds.receipt.fields.verified_by') }}</label>
                <select class="form-control select2 {{ $errors->has('verified_by') ? 'is-invalid' : '' }}" name="verified_by_id" id="verified_by_id" required>
                    @foreach($verified_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('verified_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('verified_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('verified_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.verified_by_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.receipts.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($receipt) && $receipt->photo)
      var file = {!! json_encode($receipt->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection