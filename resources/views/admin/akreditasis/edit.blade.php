@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.akreditasi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.akreditasis.update", [$akreditasi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="fakultas_id">{{ trans('cruds.akreditasi.fields.fakultas') }}</label>
                <select class="form-control select2 {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id">
                    @foreach($fakultas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fakultas_id') ? old('fakultas_id') : $akreditasi->fakultas->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fakultas'))
                    <span class="text-danger">{{ $errors->first('fakultas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prodi_id">{{ trans('cruds.akreditasi.fields.prodi') }}</label>
                <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id">
                    @foreach($prodis as $id => $entry)
                        <option value="{{ $id }}" {{ (old('prodi_id') ? old('prodi_id') : $akreditasi->prodi->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prodi'))
                    <span class="text-danger">{{ $errors->first('prodi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.prodi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenjang_id">{{ trans('cruds.akreditasi.fields.jenjang') }}</label>
                <select class="form-control select2 {{ $errors->has('jenjang') ? 'is-invalid' : '' }}" name="jenjang_id" id="jenjang_id">
                    @foreach($jenjangs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('jenjang_id') ? old('jenjang_id') : $akreditasi->jenjang->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenjang'))
                    <span class="text-danger">{{ $errors->first('jenjang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.jenjang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lembaga_id">{{ trans('cruds.akreditasi.fields.lembaga') }}</label>
                <select class="form-control select2 {{ $errors->has('lembaga') ? 'is-invalid' : '' }}" name="lembaga_id" id="lembaga_id">
                    @foreach($lembagas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lembaga_id') ? old('lembaga_id') : $akreditasi->lembaga->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lembaga'))
                    <span class="text-danger">{{ $errors->first('lembaga') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.lembaga_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_sk">{{ trans('cruds.akreditasi.fields.no_sk') }}</label>
                <input class="form-control {{ $errors->has('no_sk') ? 'is-invalid' : '' }}" type="text" name="no_sk" id="no_sk" value="{{ old('no_sk', $akreditasi->no_sk) }}">
                @if($errors->has('no_sk'))
                    <span class="text-danger">{{ $errors->first('no_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.no_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_sk">{{ trans('cruds.akreditasi.fields.tgl_sk') }}</label>
                <input class="form-control date {{ $errors->has('tgl_sk') ? 'is-invalid' : '' }}" type="text" name="tgl_sk" id="tgl_sk" value="{{ old('tgl_sk', $akreditasi->tgl_sk) }}">
                @if($errors->has('tgl_sk'))
                    <span class="text-danger">{{ $errors->first('tgl_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.tgl_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_awal_sk">{{ trans('cruds.akreditasi.fields.tgl_awal_sk') }}</label>
                <input class="form-control date {{ $errors->has('tgl_awal_sk') ? 'is-invalid' : '' }}" type="text" name="tgl_awal_sk" id="tgl_awal_sk" value="{{ old('tgl_awal_sk', $akreditasi->tgl_awal_sk) }}">
                @if($errors->has('tgl_awal_sk'))
                    <span class="text-danger">{{ $errors->first('tgl_awal_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.tgl_awal_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_akhir_sk">{{ trans('cruds.akreditasi.fields.tgl_akhir_sk') }}</label>
                <input class="form-control date {{ $errors->has('tgl_akhir_sk') ? 'is-invalid' : '' }}" type="text" name="tgl_akhir_sk" id="tgl_akhir_sk" value="{{ old('tgl_akhir_sk', $akreditasi->tgl_akhir_sk) }}">
                @if($errors->has('tgl_akhir_sk'))
                    <span class="text-danger">{{ $errors->first('tgl_akhir_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.tgl_akhir_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_expired">{{ trans('cruds.akreditasi.fields.tahun_expired') }}</label>
                <input class="form-control {{ $errors->has('tahun_expired') ? 'is-invalid' : '' }}" type="number" name="tahun_expired" id="tahun_expired" value="{{ old('tahun_expired', $akreditasi->tahun_expired) }}" step="1">
                @if($errors->has('tahun_expired'))
                    <span class="text-danger">{{ $errors->first('tahun_expired') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.tahun_expired_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.akreditasi.fields.peringkat') }}</label>
                <select class="form-control {{ $errors->has('peringkat') ? 'is-invalid' : '' }}" name="peringkat" id="peringkat">
                    <option value disabled {{ old('peringkat', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Akreditasi::PERINGKAT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('peringkat', $akreditasi->peringkat) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('peringkat'))
                    <span class="text-danger">{{ $errors->first('peringkat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.peringkat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai">{{ trans('cruds.akreditasi.fields.nilai') }}</label>
                <input class="form-control {{ $errors->has('nilai') ? 'is-invalid' : '' }}" type="number" name="nilai" id="nilai" value="{{ old('nilai', $akreditasi->nilai) }}" step="1">
                @if($errors->has('nilai'))
                    <span class="text-danger">{{ $errors->first('nilai') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.nilai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sertifikat">{{ trans('cruds.akreditasi.fields.sertifikat') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sertifikat') ? 'is-invalid' : '' }}" id="sertifikat-dropzone">
                </div>
                @if($errors->has('sertifikat'))
                    <span class="text-danger">{{ $errors->first('sertifikat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.sertifikat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_penunjang">{{ trans('cruds.akreditasi.fields.file_penunjang') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_penunjang') ? 'is-invalid' : '' }}" id="file_penunjang-dropzone">
                </div>
                @if($errors->has('file_penunjang'))
                    <span class="text-danger">{{ $errors->first('file_penunjang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.file_penunjang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.akreditasi.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $akreditasi->note) }}</textarea>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.akreditasi.fields.note_helper') }}</span>
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
    url: '{{ route('admin.akreditasis.storeMedia') }}',
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
@if(isset($akreditasi) && $akreditasi->sertifikat)
      var file = {!! json_encode($akreditasi->sertifikat) !!}
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
    url: '{{ route('admin.akreditasis.storeMedia') }}',
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
@if(isset($akreditasi) && $akreditasi->file_penunjang)
          var files =
            {!! json_encode($akreditasi->file_penunjang) !!}
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