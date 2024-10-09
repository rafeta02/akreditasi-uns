@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.akreditasiIntenasional.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.akreditasi-intenasionals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fakultas_id">{{ trans('cruds.akreditasiIntenasional.fields.fakultas') }}</label>
                <select class="form-control select2 {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id">
                    @foreach($fakultas as $id => $entry)
                        <option value="{{ $id }}" {{ old('fakultas_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fakultas'))
                    <span class="text-danger">{{ $errors->first('fakultas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prodi_id">{{ trans('cruds.akreditasiIntenasional.fields.prodi') }}</label>
                <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id">
                    @foreach($prodis as $id => $entry)
                        <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prodi'))
                    <span class="text-danger">{{ $errors->first('prodi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.prodi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lembaga_id">{{ trans('cruds.akreditasiIntenasional.fields.lembaga') }}</label>
                <select class="form-control select2 {{ $errors->has('lembaga') ? 'is-invalid' : '' }}" name="lembaga_id" id="lembaga_id">
                    @foreach($lembagas as $id => $entry)
                        <option value="{{ $id }}" {{ old('lembaga_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lembaga'))
                    <span class="text-danger">{{ $errors->first('lembaga') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.lembaga_helper') }}</span>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="no_sk">{{ trans('cruds.akreditasiIntenasional.fields.no_sk') }}</label>
                        <input class="form-control {{ $errors->has('no_sk') ? 'is-invalid' : '' }}" type="text" name="no_sk" id="no_sk" value="{{ old('no_sk', '') }}">
                        @if($errors->has('no_sk'))
                            <span class="text-danger">{{ $errors->first('no_sk') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.no_sk_helper') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tgl_sk">{{ trans('cruds.akreditasiIntenasional.fields.tgl_sk') }}</label>
                        <input class="form-control date {{ $errors->has('tgl_sk') ? 'is-invalid' : '' }}" type="text" name="tgl_sk" id="tgl_sk" value="{{ old('tgl_sk') }}">
                        @if($errors->has('tgl_sk'))
                            <span class="text-danger">{{ $errors->first('tgl_sk') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.tgl_sk_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tgl_akhir_sk">{{ trans('cruds.akreditasiIntenasional.fields.tgl_akhir_sk') }}</label>
                <input class="form-control date {{ $errors->has('tgl_akhir_sk') ? 'is-invalid' : '' }}" type="text" name="tgl_akhir_sk" id="tgl_akhir_sk" value="{{ old('tgl_akhir_sk') }}">
                @if($errors->has('tgl_akhir_sk'))
                    <span class="text-danger">{{ $errors->first('tgl_akhir_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.tgl_akhir_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('diakui_dikti') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="diakui_dikti" value="0">
                    <input class="form-check-input" type="checkbox" name="diakui_dikti" id="diakui_dikti" value="1" {{ old('diakui_dikti', 0) == 1 || old('diakui_dikti') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="diakui_dikti">{{ trans('cruds.akreditasiIntenasional.fields.diakui_dikti') }}</label>
                </div>
                @if($errors->has('diakui_dikti'))
                    <span class="text-danger">{{ $errors->first('diakui_dikti') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.diakui_dikti_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat">{{ trans('cruds.akreditasiIntenasional.fields.sertifikat') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sertifikat') ? 'is-invalid' : '' }}" id="sertifikat-dropzone">
                </div>
                @if($errors->has('sertifikat'))
                    <span class="text-danger">{{ $errors->first('sertifikat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.sertifikat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_penunjang">{{ trans('cruds.akreditasiIntenasional.fields.file_penunjang') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_penunjang') ? 'is-invalid' : '' }}" id="file_penunjang-dropzone">
                </div>
                @if($errors->has('file_penunjang'))
                    <span class="text-danger">{{ $errors->first('file_penunjang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.file_penunjang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.akreditasiIntenasional.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note') }}</textarea>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasiIntenasional.fields.note_helper') }}</span>
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
    Dropzone.options.sertifikatDropzone = {
    url: '{{ route('admin.akreditasi-intenasionals.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 2000,
      height: 2000
    },
    success: function (file, response) {
      $('form').find('input[name="sertifikat"]').remove()
      $('form').append('<input type="hidden" name="sertifikat" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="sertifikat"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($akreditasiIntenasional) && $akreditasiIntenasional->sertifikat)
      var file = {!! json_encode($akreditasiIntenasional->sertifikat) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="sertifikat" value="' + file.file_name + '">')
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
<script>
    var uploadedFilePenunjangMap = {}
Dropzone.options.filePenunjangDropzone = {
    url: '{{ route('admin.akreditasi-intenasionals.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_penunjang[]" value="' + response.name + '">')
      uploadedFilePenunjangMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilePenunjangMap[file.name]
      }
      $('form').find('input[name="file_penunjang[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($akreditasiIntenasional) && $akreditasiIntenasional->file_penunjang)
          var files =
            {!! json_encode($akreditasiIntenasional->file_penunjang) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_penunjang[]" value="' + file.file_name + '">')
            }
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
