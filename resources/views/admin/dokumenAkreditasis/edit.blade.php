@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.dokumenAkreditasi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dokumen-akreditasis.update", [$dokumenAkreditasi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ajuan_id">{{ trans('cruds.dokumenAkreditasi.fields.ajuan') }}</label>
                <select class="form-control select2 {{ $errors->has('ajuan') ? 'is-invalid' : '' }}" name="ajuan_id" id="ajuan_id">
                    @foreach($ajuans as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ajuan_id') ? old('ajuan_id') : $dokumenAkreditasi->ajuan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ajuan'))
                    <span class="text-danger">{{ $errors->first('ajuan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.ajuan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.dokumenAkreditasi.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $dokumenAkreditasi->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dokumenAkreditasi.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DokumenAkreditasi::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $dokumenAkreditasi->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.dokumenAkreditasi.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.dokumenAkreditasi.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', $dokumenAkreditasi->note) }}">
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owned_by_id">{{ trans('cruds.dokumenAkreditasi.fields.owned_by') }}</label>
                <select class="form-control select2 {{ $errors->has('owned_by') ? 'is-invalid' : '' }}" name="owned_by_id" id="owned_by_id">
                    @foreach($owned_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('owned_by_id') ? old('owned_by_id') : $dokumenAkreditasi->owned_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owned_by'))
                    <span class="text-danger">{{ $errors->first('owned_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dokumenAkreditasi.fields.owned_by_helper') }}</span>
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
    Dropzone.options.fileDropzone = {
    url: '{{ route('admin.dokumen-akreditasis.storeMedia') }}',
    maxFilesize: 25, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25
    },
    success: function (file, response) {
      $('form').find('input[name="file"]').remove()
      $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($dokumenAkreditasi) && $dokumenAkreditasi->file)
      var file = {!! json_encode($dokumenAkreditasi->file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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